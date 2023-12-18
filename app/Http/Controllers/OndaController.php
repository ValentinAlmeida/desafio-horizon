<?php

namespace App\Http\Controllers;

use App\Http\Requests\OndaValidateRequest;
use App\Models\Onda;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

/**
 * Controlador para gerenciar operações relacionadas às ondas.
 */
class OndaController extends Controller
{
    /**
     * Retorna todas as ondas.
     *
     * @return Collection|Onda[]
     */
    public function index(): Collection
    {
        return Onda::all();
    }

    /**
     * Armazena uma nova onda.
     *
     * @param OndaValidateRequest $request
     * @return Onda
     */
    public function store(OndaValidateRequest $request): Onda
    {
        return Onda::create($request->all());
    }

    /**
     * Exibe os detalhes de uma onda específica.
     *
     * @param Onda $onda
     * @return Onda
     */
    public function show(Onda $onda): Onda
    {
        return $onda;
    }

    /**
     * Atualiza os detalhes de uma onda existente.
     *
     * @param OndaValidateRequest $request
     * @param Onda $onda
     * @return Onda
     */
    public function update(OndaValidateRequest $request, Onda $onda): Onda
    {
        $onda->update($request->all());

        return $onda;
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
     * Restaura uma onda previamente excluído.
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