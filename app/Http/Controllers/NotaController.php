<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaController extends Controller
{
    /**
     * Retorna todas as notas.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $notas = Nota::all();

        return response()->json(['data' => $notas], 200);
    }

    /**
     * Armazena uma nova nota.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'onda_id' => 'required|exists:ondas,id',
            'notaParcial1' => 'required|numeric|min:0|max:10',
            'notaParcial2' => 'required|numeric|min:0|max:10',
            'notaParcial3' => 'required|numeric|min:0|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $nota = Nota::create($request->all());

        return response()->json(['message' => 'Nota criada com sucesso', 'data' => $nota], 201);
    }

    /**
     * Exibe os detalhes de uma nota específica.
     *
     * @param Nota $nota
     * @return JsonResponse
     */
    public function show(Nota $nota): JsonResponse
    {
        return response()->json(['data' => $nota], 200);
    }

    /**
     * Atualiza os detalhes de uma nota existente.
     *
     * @param Request $request
     * @param Nota $nota
     * @return JsonResponse
     */
    public function update(Request $request, Nota $nota): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'onda_id' => 'required|exists:ondas,id',
            'notaParcial1' => 'required|numeric|min:0|max:10',
            'notaParcial2' => 'required|numeric|min:0|max:10',
            'notaParcial3' => 'required|numeric|min:0|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $nota->update($request->all());

        return response()->json(['message' => 'Nota atualizada com sucesso', 'data' => $nota], 200);
    }

    /**
     * Exclui uma nota específica.
     *
     * @param Nota $nota
     * @return JsonResponse
     */
    public function destroy(Nota $nota): JsonResponse
    {
        $nota->delete();

        return response()->json(['message' => 'Nota deletada'], 200);
    }

    /**
     * Restaura uma nota previamente excluída.
     *
     * @param int $notaId
     * @return JsonResponse
     */
    public function restorePost($notaId): JsonResponse
    {
        $nota = Nota::withTrashed()->find($notaId);

        if (!$nota) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }

        if ($nota->restore()) {
            return response()->json(['message' => 'Nota restaurada'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar a nota'], 500);
    }
}
