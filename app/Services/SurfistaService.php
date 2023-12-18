<?php

namespace App\Services;

use App\Repositories\Contracts\SurfistaRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class SurfistaService
{
    protected $surfistaRepository;

    public function __construct(SurfistaRepositoryInterface $surfistaRepository)
    {
        $this->surfistaRepository = $surfistaRepository;
    }

    /**
     * Retorna todos os surfistas.
     *
     * @return Collection|Surfista[]
     */
    public function getAllSurfistas()
    {
        return $this->surfistaRepository->getAllSurfistas();
    }

    /**
     * Retorna um surfista por ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getSurfistaById(int $id)
    {
        return $this->surfistaRepository->getSurfistaById($id);
    }

    /**
     * Cria um novo surfista.
     *
     * @param array $data
     * @return mixed
     */
    public function createSurfista(array $data)
    {
        return $this->surfistaRepository->createSurfista($data);
    }

    /**
     * Atualiza um surfista existente.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateSurfista(int $id, array $data)
    {
        return $this->surfistaRepository->updateSurfista($id, $data);
    }

    /**
     * Exclui um surfista específico.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteSurfista(int $id): JsonResponse
    {
        $deleted = $this->surfistaRepository->deleteSurfista($id);

        if ($deleted) {
            return response()->json(['message' => 'Surfista deletado'], 200);
        }

        return response()->json(['message' => 'Surfista não encontrado'], 404);
    }

    /**
     * Restaura um surfista previamente excluído.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restoreSurfista(int $id): JsonResponse
    {
        $restored = $this->surfistaRepository->restoreSurfista($id);

        if ($restored) {
            return response()->json(['message' => 'Surfista restaurado'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar o Surfista'], 500);
    }
}