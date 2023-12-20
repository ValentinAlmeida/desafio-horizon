<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\NotaService;
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $notas = $this->notaService->getAllNotas();

        return response()->json($notas);
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

        $nota = $this->notaService->createNota($request->all());

        return response()->json(['message' => 'Nota criada com sucesso', 'data' => $nota], 201);
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
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
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

        $nota = $this->notaService->updateNota($id, $request->all());

        return response()->json(['message' => 'Nota atualizada com sucesso', 'data' => $nota]);
    }

    /**
     * Exclui uma nota específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $response = $this->notaService->deleteNota($id);

        return response()->json($response);
    }

    /**
     * Restaura uma nota previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $response = $this->notaService->restoreNota($id);

        return response()->json($response);
    }
}
