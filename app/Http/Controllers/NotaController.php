<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotaValidateRequest;
use App\Services\NotaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

/**
 * Controlador para gerenciar operações relacionadas às notas.
 */
class NotaController extends Controller
{
    /**
     * Serviço para manipulação de notas.
     *
     * @var NotaService
     */
    protected $notaService;

    /**
     * Construtor do controlador.
     *
     * @param NotaService $notaService
     */
    public function __construct(NotaService $notaService)
    {
        $this->notaService = $notaService;
    }

    /**
     * Retorna todas as notas.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->notaService->getAllNotas();
    }

    /**
     * Armazena uma nova nota.
     *
     * @param NotaValidateRequest $request
     * @return JsonResponse
     */
    public function store(NotaValidateRequest $request): JsonResponse
    {
        $nota = $this->notaService->createNota($request->all());

        return response()->json($nota, 201);
    }

    /**
     * Exibe os detalhes de uma nota específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $nota = $this->notaService->getNotaById($id);

        if (!$nota) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }

        return response()->json($nota);
    }

    /**
     * Atualiza os detalhes de uma nota existente.
     *
     * @param NotaValidateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(NotaValidateRequest $request, int $id): JsonResponse
    {
        $nota = $this->notaService->updateNota($id, $request->all());

        return response()->json($nota);
    }

    /**
     * Exclui uma nota específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->notaService->deleteNota($id);
    }

    /**
     * Restaura uma nota previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        return $this->notaService->restoreNota($id);
    }
}
