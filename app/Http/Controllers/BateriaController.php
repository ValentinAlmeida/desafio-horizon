<?php

namespace App\Http\Controllers;

use App\Http\Requests\BateriaValidateRequest;
use App\Services\BateriaService;
use App\Models\Surfista;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class BateriaController extends Controller
{
    protected $bateriaService;

    public function __construct(BateriaService $bateriaService)
    {
        $this->bateriaService = $bateriaService;
    }

    /**
     * Retorna todas as baterias.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $baterias = $this->bateriaService->getAllBaterias();
    }

    /**
     * Armazena uma nova bateria.
     *
     * @param BateriaValidateRequest $request
     * @return BateriaResource
     */
    public function store(BateriaValidateRequest $request): JsonResponse
    {
        $bateria = $this->bateriaService->createBateria($request->all());

        return response()->json($bateria, 201);
    }

    /**
     * Exibe os detalhes de uma bateria específica.
     *
     * @param int $id
     * @return BateriaResource|JsonResponse
     */
    public function show(int $id)
    {
        $bateria = $this->bateriaService->getBateriaById($id);

        if (!$bateria) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }

        return response()->json($bateria);
    }

    /**
     * Atualiza os detalhes de uma bateria existente.
     *
     * @param BateriaValidateRequest $request
     * @param int $id
     * @return BateriaResource|JsonResponse
     */
    public function update(BateriaValidateRequest $request, int $id)
    {
        $bateria = $this->bateriaService->updateBateria($id, $request->all());

        return response()->json($bateria);
    }

    /**
     * Exclui uma bateria específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->bateriaService->deleteBateria($id);
    }

    /**
     * Restaura uma bateria previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        return $this->bateriaService->restoreBateria($id);
    }

    /**
     * Obtém o surfista vencedor com base nas pontuações das ondas.
     *
     * @param int $id
     * @return BateriaResource|JsonResponse
     */
    public function getVencedor(int $id): JsonResponse
    {
        $bateria = $this->bateriaService->getBateriaById($id);

        if (!$bateria) {
            return response()->json(['message' => 'Bateria não encontrada'], 404);
        }

        $surfista1 = Surfista::find($bateria->surfista1);
        $surfista2 = Surfista::find($bateria->surfista2);

        $pontuacaoSurfista1 = $this->calcularPontuacao($surfista1->numero, $bateria->ondas);
        $pontuacaoSurfista2 = $this->calcularPontuacao($surfista2->numero, $bateria->ondas);

        if ($pontuacaoSurfista1 > $pontuacaoSurfista2) {
            return response()->json($surfista1);
        }
        if ($pontuacaoSurfista2 > $pontuacaoSurfista1) {
            return response()->json($surfista2);
        }

        return response()->json(['message' => 'Empate'], 200);
    }

    /**
     * Calcula a pontuação total de um surfista com base nas ondas.
     *
     * @param int $surfistaId
     * @param Collection $ondas
     * @return float
     */
    private function calcularPontuacao(int $surfistaId, Collection $ondas): float
    {
        $pontuacao = 0;

        foreach ($ondas as $onda) {
            if ($onda->surfista_id == $surfistaId) {
                $mediaNota = ($onda->nota->notaParcial1 + $onda->nota->notaParcial2 + $onda->nota->notaParcial3) / 3;

                $pontuacao += $mediaNota;
            }
        }
        return $pontuacao;
    }
}