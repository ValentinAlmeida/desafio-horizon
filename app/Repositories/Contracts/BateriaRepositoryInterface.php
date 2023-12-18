<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Bateria;

interface BateriaRepositoryInterface
{
    /**
     * Retorna todas as baterias.
     *
     * @return Collection|Bateria[]
     */
    public function getAllBaterias();

    /**
     * Retorna uma bateria por ID.
     *
     * @param int $id
     * @return Bateria|null
     */
    public function getBateriaById(int $id);

    /**
     * Cria uma nova bateria.
     *
     * @param array $data
     * @return Bateria
     */
    public function createBateria(array $data): Bateria;

    /**
     * Atualiza uma bateria existente.
     *
     * @param int $id
     * @param array $data
     * @return Bateria|null
     */
    public function updateBateria(int $id, array $data): ?Bateria;

    /**
     * Exclui uma bateria específica.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBateria(int $id): bool;

    /**
     * Restaura uma bateria previamente excluída.
     *
     * @param int $id
     * @return bool
     */
    public function restoreBateria(int $id): bool;
}
