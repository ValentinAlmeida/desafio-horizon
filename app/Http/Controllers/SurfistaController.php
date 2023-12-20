<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\SurfistaService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Controlador para gerenciar operações relacionadas aos surfistas.
 */
class SurfistaController extends Controller
{
    /**
     * Serviço para manipulação de surfistas.
     *
     * @var SurfistaService
     */
    protected $surfistaService;

    /**
     * Construtor do controlador.
     *
     * @param SurfistaService $surfistaService
     */
    public function __construct(SurfistaService $surfistaService)
    {
        $this->surfistaService = $surfistaService;
    }

    /**
     * Retorna todos os surfistas.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $surfistas = $this->surfistaService->getAllSurfistas();

        return response()->json($surfistas);
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

        $surfista = $this->surfistaService->createSurfista($request->all());

        return response()->json(['message' => 'Surfista criado com sucesso', 'data' => $surfista], 201);
    }

    /**
     * Exibe os detalhes de um surfista específico.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $surfista = $this->surfistaService->getSurfistaById($id);

        if (!$surfista) {
            return response()->json(['message' => 'Surfista não encontrado'], 404);
        }

        return response()->json($surfista);
    }

    /**
     * Atualiza os detalhes de um surfista existente.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $surfista = $this->surfistaService->updateSurfista($id, $request->all());

        return response()->json(['message' => 'Surfista atualizado com sucesso', 'data' => $surfista]);
    }

    /**
     * Exclui um surfista específico.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $response = $this->surfistaService->deleteSurfista($id);

        return response()->json($response);
    }

    /**
     * Restaura um surfista previamente excluído.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $response = $this->surfistaService->restoreSurfista($id);

        return response()->json($response);
    }
}