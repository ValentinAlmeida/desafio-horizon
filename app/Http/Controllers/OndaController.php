<?php

namespace App\Http\Controllers;

use App\Models\Onda;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controlador para gerenciar operações relacionadas às ondas.
 */
class OndaController extends Controller
{
    /**
     * Retorna todas as ondas.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $ondas = Onda::all();

        return response()->json(['data' => $ondas], 200);
    }

    /**
     * Armazena uma nova onda.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'bateria_id' => 'required|exists:baterias,id',
            'surfista_id' => 'required|exists:surfistas,numero',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $onda = Onda::create($request->all());

        return response()->json(['message' => 'Onda criada com sucesso', 'data' => $onda], 201);
    }

    /**
     * Exibe os detalhes de uma onda específica.
     *
     * @param Onda $onda
     * @return JsonResponse
     */
    public function show(Onda $onda): JsonResponse
    {
        return response()->json(['data' => $onda], 200);
    }

    /**
     * Atualiza os detalhes de uma onda existente.
     *
     * @param Request $request
     * @param Onda $onda
     * @return JsonResponse
     */
    public function update(Request $request, Onda $onda): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'bateria_id' => 'required|exists:baterias,id',
            'surfista_id' => 'required|exists:surfistas,numero',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $onda->update($request->all());

        return response()->json(['message' => 'Onda atualizada com sucesso', 'data' => $onda], 200);
    }

    /**
     * Exclui uma onda específica.
     *
     * @param Onda $onda
     * @return JsonResponse
     */
    public function destroy(Onda $onda): JsonResponse
    {
        $onda->delete();

        return response()->json(['message' => 'Onda deletada'], 200);
    }

    /**
     * Restaura uma onda previamente excluída.
     *
     * @param int $ondaId
     * @return JsonResponse
     */
    public function restorePost($ondaId): JsonResponse
    {
        $onda = Onda::withTrashed()->find($ondaId);

        if (!$onda) {
            return response()->json(['message' => 'Onda não encontrada'], 404);
        }

        if ($onda->restore()) {
            return response()->json(['message' => 'Onda restaurada'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar a Onda'], 500);
    }
}