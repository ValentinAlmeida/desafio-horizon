<?php

namespace App\Services;

use App\Repositories\Contracts\OndaRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class OndaService
{
    protected $ondaRepository;

    public function __construct(OndaRepositoryInterface $ondaRepository)
    {
        $this->ondaRepository = $ondaRepository;
    }

    /**
     * Retorna todas as ondas.
     *
     * @return Collection|Onda[]
     */
    public function getAllOndas()
    {
        return $this->ondaRepository->getAllOndas();
    }

    /**
     * Retorna uma onda por ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getOndaById(int $id)
    {
        return $this->ondaRepository->getOndaById($id);
    }

    /**
     * Cria uma nova onda.
     *
     * @param array $data
     * @return mixed
     */
    public function createOnda(array $data)
    {
        return $this->ondaRepository->createOnda($data);
    }

    /**
     * Atualiza uma onda existente.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateOnda(int $id, array $data)
    {
        return $this->ondaRepository->updateOnda($id, $data);
    }

    /**
     * Exclui uma onda específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteOnda(int $id): JsonResponse
    {
        $deleted = $this->ondaRepository->deleteOnda($id);

        if ($deleted) {
            return response()->json(['message' => 'Onda deletada'], 200);
        }

        return response()->json(['message' => 'Onda não encontrada'], 404);
    }

    /**
     * Restaura uma onda previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restoreOnda(int $id): JsonResponse
    {
        $restored = $this->ondaRepository->restoreOnda($id);

        if ($restored) {
            return response()->json(['message' => 'Onda restaurada'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar a Onda'], 500);
    }
}