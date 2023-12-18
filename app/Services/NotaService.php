<?php

namespace App\Services;

use App\Repositories\Contracts\NotaRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class NotaService
{
    protected $notaRepository;

    public function __construct(NotaRepositoryInterface $notaRepository)
    {
        $this->notaRepository = $notaRepository;
    }

    /**
     * Retorna todas as notas.
     *
     * @return Collection|Nota[]
     */
    public function getAllNotas()
    {
        return $this->notaRepository->getAllNotas();
    }

    /**
     * Retorna uma nota por ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getNotaById(int $id)
    {
        return $this->notaRepository->getNotaById($id);
    }

    /**
     * Cria uma nova nota.
     *
     * @param array $data
     * @return mixed
     */
    public function createNota(array $data)
    {
        return $this->notaRepository->createNota($data);
    }

    /**
     * Atualiza uma nota existente.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateNota(int $id, array $data)
    {
        return $this->notaRepository->updateNota($id, $data);
    }

    /**
     * Exclui uma nota específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteNota(int $id): JsonResponse
    {
        $deleted = $this->notaRepository->deleteNota($id);

        if ($deleted) {
            return response()->json(['message' => 'Nota deletada'], 200);
        }

        return response()->json(['message' => 'Nota não encontrada'], 404);
    }

    /**
     * Restaura uma nota previamente excluída.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restoreNota(int $id): JsonResponse
    {
        $restored = $this->notaRepository->restoreNota($id);

        if ($restored) {
            return response()->json(['message' => 'Nota restaurada'], 200);
        }

        return response()->json(['message' => 'Não foi possível restaurar a Nota'], 500);
    }
}
