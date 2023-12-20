<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\OndaService;
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $ondas = $this->ondaService->getAllOndas();

        return response()->json($ondas);
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

        $onda = $this->ondaService->createOnda($request->all());

        return response()->json(['message' => 'Onda criada com sucesso', 'data' => $onda], 201);
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
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'bateria_id' => 'required|exists:baterias,id',
            'surfista_id' => 'required|exists:surfistas,numero',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $onda = $this->ondaService->updateOnda($id, $request->all());

        return response()->json(['message' => 'Onda atualizada com sucesso', 'data' => $onda]);
    }

    /**
     * Exclui uma onda específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $response = $this->ondaService->deleteOnda($id);

        return response()->json($response);
    }

    /**
     * Restaura uma onda previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $response = $this->ondaService->restoreOnda($id);

        return response()->json($response);
    }
}
