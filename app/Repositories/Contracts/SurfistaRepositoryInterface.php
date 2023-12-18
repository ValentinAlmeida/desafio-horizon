<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Surfista;

interface SurfistaRepositoryInterface
{
    /**
     * Retorna todos os surfistas.
     *
     * @return Collection|Surfista[]
     */
    public function getAllSurfistas();

    /**
     * Retorna um surfista por ID.
     *
     * @param int $id
     * @return Surfista|null
     */
    public function getSurfistaById(int $id);

    /**
     * Cria um novo surfista.
     *
     * @param array $data
     * @return Surfista
     */
    public function createSurfista(array $data): Surfista;

    /**
     * Atualiza um surfista existente.
     *
     * @param int $id
     * @param array $data
     * @return Surfista|null
     */
    public function updateSurfista(int $id, array $data): ?Surfista;

    /**
     * Exclui um surfista específico.
     *
     * @param int $id
     * @return bool
     */
    public function deleteSurfista(int $id): bool;

    /**
     * Restaura um surfista previamente excluído.
     *
     * @param int $id
     * @return bool
     */
    public function restoreSurfista(int $id): bool;
}
