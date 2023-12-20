<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\BateriaService;
use App\Models\Surfista;
use Illuminate\Database\Eloquent\Collection;

/**
 * Controlador para gerenciar operações relacionadas às baterias.
 */
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $baterias = $this->bateriaService->getAllBaterias();

        return response()->json($baterias);
    }

    /**
     * Armazena uma nova bateria.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'surfista1' => 'required|exists:surfistas,numero',
            'surfista2' => 'required|exists:surfistas,numero|different:surfista1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $bateria = $this->bateriaService->createBateria($request->all());

        return response()->json(['message' => 'Bateria criada com sucesso', 'data' => $bateria], 201);
    }

    /**
     * Exibe os detalhes de uma bateria específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $bateria = $this->bateriaService->getBateriaById($id);

        if (!$bateria) {
            return response()->json(['message' => 'Bateria não encontrada'], 404);
        }

        return response()->json($bateria);
    }

    /**
     * Atualiza os detalhes de uma bateria existente.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'surfista1' => 'required|exists:surfistas,numero',
            'surfista2' => 'required|exists:surfistas,numero|different:surfista1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $bateria = $this->bateriaService->updateBateria($id, $request->all());

        return response()->json(['message' => 'Bateria atualizada com sucesso', 'data' => $bateria]);
    }

    /**
     * Exclui uma bateria específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $response = $this->bateriaService->deleteBateria($id);

        return response()->json($response);
    }

    /**
     * Restaura uma bateria previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $response = $this->bateriaService->restoreBateria($id);

        return response()->json($response);
    }

    /**
     * Obtém o surfista vencedor com base nas pontuações das ondas.
     *
     * @param int $id
     * @return JsonResponse
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