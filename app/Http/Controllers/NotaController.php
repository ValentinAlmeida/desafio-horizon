<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotaValidateRequest;
use App\Models\Nota;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

/**
 * Controlador para gerenciar operações relacionadas às notas.
 */
class NotaController extends Controller
{
    /**
     * Retorna todas as notas.
     *
     * @return Collection|Nota[]
     */
    public function index(): Collection
    {
        return Nota::all();
    }

    /**
     * Armazena uma nova nota.
     *
     * @param  NotaValidateRequest  $request
     * @return Nota
     */
    public function store(NotaValidateRequest $request): Nota
    {
        return Nota::create($request->all());
    }

    /**
     * Exibe os detalhes de uma nota específica.
     *
     * @param  Nota  $nota
     * @return Nota
     */
    public function show(Nota $nota): Nota
    {
        return $nota;
    }

    /**
     * Atualiza os detalhes de uma nota existente.
     *
     * @param  NotaValidateRequest  $request
     * @param  Nota  $nota
     * @return Nota
     */
    public function update(NotaValidateRequest $request, Nota $nota): Nota
    {
        $nota->update($request->all());

        return $nota;
    }

    /**
     * Exclui uma nota específica.
     *
     * @param  Nota  $nota
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
        $notaId = Nota::withTrashed()->find($notaId);

        if (!$notaId) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }

        if ($notaId->restore()) {
            return response()->json(['message' => 'Nota restaurada'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar a nota'], 500);
    }
}