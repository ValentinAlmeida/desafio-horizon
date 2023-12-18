<?php

namespace App\Http\Controllers;

use App\Http\Requests\OndaValidateRequest;
use App\Services\OndaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

/**
 * Controlador para gerenciar operações relacionadas às ondas.
 */
class OndaController extends Controller
{
    /**
     * Serviço para manipulação de ondas.
     *
     * @var OndaService
     */
    protected $ondaService;

    /**
     * Construtor do controlador.
     *
     * @param OndaService $ondaService
     */
    public function __construct(OndaService $ondaService)
    {
        $this->ondaService = $ondaService;
    }

    /**
     * Retorna todas as ondas.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->ondaService->getAllOndas();
    }

    /**
     * Armazena uma nova onda.
     *
     * @param OndaValidateRequest $request
     * @return JsonResponse
     */
    public function store(OndaValidateRequest $request): JsonResponse
    {
        $onda = $this->ondaService->createOnda($request->all());

        return response()->json($onda, 201);
    }

    /**
     * Exibe os detalhes de uma onda específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $onda = $this->ondaService->getOndaById($id);

        if (!$onda) {
            return response()->json(['message' => 'Onda não encontrada'], 404);
        }

        return response()->json($onda);
    }

    /**
     * Atualiza os detalhes de uma onda existente.
     *
     * @param OndaValidateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(OndaValidateRequest $request, int $id): JsonResponse
    {
        $onda = $this->ondaService->updateOnda($id, $request->all());

        return response()->json($onda);
    }

    /**
     * Exclui uma onda específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->ondaService->deleteOnda($id);
    }

    /**
     * Restaura uma onda previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        return $this->ondaService->restoreOnda($id);
    }
}
