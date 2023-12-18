<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Nota;

interface NotaRepositoryInterface
{
    /**
     * Retorna todas as notas.
     *
     * @return Collection|Nota[]
     */
    public function getAllNotas();

    /**
     * Retorna uma nota por ID.
     *
     * @param int $id
     * @return Nota|null
     */
    public function getNotaById(int $id);

    /**
     * Cria uma nova nota.
     *
     * @param array $data
     * @return Nota
     */
    public function createNota(array $data);

    /**
     * Atualiza uma nota existente.
     *
     * @param int $id
     * @param array $data
     * @return Nota|null
     */
    public function updateNota(int $id, array $data);

    /**
     * Exclui uma nota específica.
     *
     * @param int $id
     * @return bool
     */
    public function deleteNota(int $id);

    /**
     * Restaura uma nota previamente excluída.
     *
     * @param int $id
     * @return bool
     */
    public function restoreNota(int $id);
}
