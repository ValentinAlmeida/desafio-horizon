<?php

namespace App\Repositories;

use App\Models\Bateria;
use App\Repositories\Contracts\BateriaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BateriaRepository implements BateriaRepositoryInterface
{
    protected $bateria;

    public function __construct(Bateria $bateria)
    {
        $this->bateria = $bateria;
    }

    public function getAllBaterias(): Collection
    {
        return $this->bateria->all();
    }

    public function getBateriaById(int $id): ?Bateria
    {
        return $this->bateria->find($id);
    }

    public function createBateria(array $data): Bateria
    {
        return $this->bateria->create($data);
    }

    public function updateBateria(int $id, array $data): ?Bateria
    {
        $bateria = $this->bateria->find($id);

        if ($bateria) {
            $bateria->update($data);
            return $bateria;
        }

        return null;
    }

    public function deleteBateria(int $id): bool
    {
        $bateria = $this->bateria->find($id);

        if ($bateria) {
            return $bateria->delete();
        }

        return false;
    }

    public function restoreBateria(int $id): bool
    {
        $bateria = $this->bateria->withTrashed()->find($id);

        if ($bateria) {
            return $bateria->restore();
        }

        return false;
    }
}