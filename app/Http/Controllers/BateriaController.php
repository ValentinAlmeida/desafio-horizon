<?php

namespace App\Http\Controllers;

use App\Models\Bateria;
use App\Models\Surfista;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controlador para gerenciar operações relacionadas às baterias de surf.
 */
class BateriaController extends Controller
{
    /**
     * Retorna todas as baterias.
     *
     * @return Collection|Bateria[]
     */
    public function index(): Collection
    {
        return Bateria::all();
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

        $bateria = Bateria::create($request->all());

        return response()->json(['message' => 'Bateria criada com sucesso', 'data' => $bateria], 201);
    }

    /**
     * Exibe os detalhes de uma bateria específica.
     *
     * @param Bateria $bateria
     * @return Bateria
     */
    public function show(Bateria $bateria): Bateria
    {
        return $bateria;
    }

    /**
     * Atualiza os detalhes de uma bateria existente.
     *
     * @param Request $request
     * @param Bateria $bateria
     * @return JsonResponse
     */
    public function update(Request $request, Bateria $bateria): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'surfista1' => 'required|exists:surfistas,numero',
            'surfista2' => 'required|exists:surfistas,numero|different:surfista1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $bateria->update($request->all());

        return response()->json(['message' => 'Bateria atualizada com sucesso', 'data' => $bateria], 200);
    }

    /**
     * Exclui uma bateria específica.
     *
     * @param Bateria $bateria
     * @return JsonResponse
     */
    public function destroy(Bateria $bateria): JsonResponse
    {
        $bateria->delete();

        return response()->json(['message' => 'Bateria deletada'], 200);
    }

    /**
     * Restaura uma bateria previamente excluída.
     *
     * @param int $bateriaId
     * @return JsonResponse
     */
    public function restorePost($bateriaId): JsonResponse
    {
        $bateriaId = Bateria::withTrashed()->find($bateriaId);

        if (!$bateriaId) {
            return response()->json(['message' => 'Bateria não encontrada'], 404);
        }

        if ($bateriaId->restore()) {
            return response()->json(['message' => 'Bateria restaurada'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar a Bateria'], 500);
    }

    /**
     * Obtém o surfista vencedor com base nas pontuações das ondas.
     *
     * @param Bateria $bateria
     * @return Surfista|string Retorna o surfista vencedor ou "Empate".
     */
    public function getVencedor(Bateria $bateria): Surfista|string
    {
        $surfista1 = Surfista::find($bateria->surfista1);
        $surfista2 = Surfista::find($bateria->surfista2);

        $pontuacaoSurfista1 = $this->calcularPontuacao($surfista1->numero, $bateria->ondas);
        $pontuacaoSurfista2 = $this->calcularPontuacao($surfista2->numero, $bateria->ondas);

        if ($pontuacaoSurfista1 > $pontuacaoSurfista2) {
            return $surfista1;
        }
        if ($pontuacaoSurfista2 > $pontuacaoSurfista1) {
            return $surfista2;
        }

        return "Empate";
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