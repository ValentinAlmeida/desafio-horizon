<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Onda;

interface OndaRepositoryInterface
{
    /**
     * Retorna todas as ondas.
     *
     * @return Collection|Onda[]
     */
    public function getAllOndas();

    /**
     * Retorna uma onda por ID.
     *
     * @param int $id
     * @return Onda|null
     */
    public function getOndaById(int $id);

    /**
     * Cria uma nova onda.
     *
     * @param array $data
     * @return Onda
     */
    public function createOnda(array $data): Onda;

    /**
     * Atualiza uma onda existente.
     *
     * @param int $id
     * @param array $data
     * @return Onda|null
     */
    public function updateOnda(int $id, array $data): ?Onda;

    /**
     * Exclui uma onda específica.
     *
     * @param int $id
     * @return bool
     */
    public function deleteOnda(int $id): bool;

    /**
     * Restaura uma onda previamente excluída.
     *
     * @param int $id
     * @return bool
     */
    public function restoreOnda(int $id): bool;
}
