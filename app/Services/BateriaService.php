<?php

namespace App\Services;

use App\Repositories\Contracts\BateriaRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class BateriaService
{
    protected $bateriaRepository;

    public function __construct(BateriaRepositoryInterface $bateriaRepository)
    {
        $this->bateriaRepository = $bateriaRepository;
    }

    /**
     * Retorna todas as baterias.
     *
     * @return Collection|Bateria[]
     */
    public function getAllBaterias()
    {
        return $this->bateriaRepository->getAllBaterias();
    }

    /**
     * Retorna uma bateria por ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getBateriaById(int $id)
    {
        return $this->bateriaRepository->getBateriaById($id);
    }

    /**
     * Cria uma nova bateria.
     *
     * @param array $data
     * @return mixed
     */
    public function createBateria(array $data)
    {
        return $this->bateriaRepository->createBateria($data);
    }

    /**
     * Atualiza uma bateria existente.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateBateria(int $id, array $data)
    {
        return $this->bateriaRepository->updateBateria($id, $data);
    }

    /**
     * Exclui uma bateria específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteBateria(int $id): JsonResponse
    {
        $deleted = $this->bateriaRepository->deleteBateria($id);

        if ($deleted) {
            return response()->json(['message' => 'Bateria deletada'], 200);
        }

        return response()->json(['message' => 'Bateria não encontrada'], 404);
    }

    /**
     * Restaura uma bateria previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restoreBateria(int $id): JsonResponse
    {
        $restored = $this->bateriaRepository->restoreBateria($id);

        if ($restored) {
            return response()->json(['message' => 'Bateria restaurada'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar a Bateria'], 500);
    }
}
