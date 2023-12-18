<?php

namespace App\Repositories;

use App\Models\Onda;
use App\Repositories\Contracts\OndaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OndaRepository implements OndaRepositoryInterface
{
    protected $onda;

    public function __construct(Onda $onda)
    {
        $this->onda = $onda;
    }

    public function getAllOndas(): Collection
    {
        return $this->onda->all();
    }

    public function getOndaById(int $id): ?Onda
    {
        return $this->onda->find($id);
    }

    public function createOnda(array $data): Onda
    {
        return $this->onda->create($data);
    }

    public function updateOnda(int $id, array $data): ?Onda
    {
        $onda = $this->onda->find($id);

        if ($onda) {
            $onda->update($data);
            return $onda;
        }

        return null;
    }

    public function deleteOnda(int $id): bool
    {
        $onda = $this->onda->find($id);

        if ($onda) {
            return $onda->delete();
        }

        return false;
    }

    public function restoreOnda(int $id): bool
    {
        $onda = $this->onda->withTrashed()->find($id);

        if ($onda) {
            return $onda->restore();
        }

        return false;
    }
}
