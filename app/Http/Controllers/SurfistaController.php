<?php

namespace App\Http\Controllers;

use App\Models\Surfista;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controlador para gerenciar operações relacionadas aos surfistas.
 */
class SurfistaController extends Controller
{
    /**
     * Retorna todos os surfistas.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $surfistas = Surfista::all();

        return response()->json(['data' => $surfistas], 200);
    }

    /**
     * Armazena um novo surfista.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $surfista = Surfista::create($request->all());

        return response()->json(['message' => 'Surfista criado com sucesso', 'data' => $surfista], 201);
    }

    /**
     * Exibe os detalhes de um surfista específico.
     *
     * @param Surfista $surfista
     * @return JsonResponse
     */
    public function show(Surfista $surfista): JsonResponse
    {
        return response()->json(['data' => $surfista], 200);
    }

    /**
     * Atualiza os detalhes de um surfista existente.
     *
     * @param Request $request
     * @param Surfista $surfista
     * @return JsonResponse
     */
    public function update(Request $request, Surfista $surfista): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $surfista->update($request->all());

        return response()->json(['message' => 'Surfista atualizado com sucesso', 'data' => $surfista], 200);
    }

    /**
     * Exclui um surfista específico.
     *
     * @param Surfista $surfista
     * @return JsonResponse
     */
    public function destroy(Surfista $surfista): JsonResponse
    {
        $surfista->delete();

        return response()->json(['message' => 'Surfista deletado'], 200);
    }

    /**
     * Restaura um surfista previamente excluído.
     *
     * @param int $surfistaId
     * @return JsonResponse
     */
    public function restorePost($surfistaId): JsonResponse
    {
        $surfista = Surfista::withTrashed()->find($surfistaId);

        if (!$surfista) {
            return response()->json(['message' => 'Surfista não encontrado'], 404);
        }

        if ($surfista->restore()) {
            return response()->json(['message' => 'Surfista restaurado'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar o Surfista'], 500);
    }
}