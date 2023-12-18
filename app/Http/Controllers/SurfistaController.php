<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurfistaValidateRequest;
use App\Models\Surfista;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

/**
 * Controlador para gerenciar operações relacionadas aos surfistas.
 */
class SurfistaController extends Controller
{
    /**
     * Retorna todos os surfistas.
     *
     * @return Collection|Surfista[]
     */
    public function index(): Collection
    {
        return Surfista::all();
    }

    /**
     * Armazena um novo surfista.
     *
     * @param SurfistaValidateRequest $request
     * @return Surfista
     */
    public function store(SurfistaValidateRequest $request): Surfista
    {
        return Surfista::create($request->all());
    }

    /**
     * Exibe os detalhes de um surfista específico.
     *
     * @param Surfista $surfista
     * @return Surfista
     */
    public function show(Surfista $surfista): Surfista
    {
        return $surfista;
    }

    /**
     * Atualiza os detalhes de um surfista existente.
     *
     * @param SurfistaValidateRequest $request
     * @param Surfista $surfista
     * @return Surfista
     */
    public function update(SurfistaValidateRequest $request, Surfista $surfista): Surfista
    {
        $surfista->update($request->all());

        return $surfista;
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
