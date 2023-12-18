<?php

namespace App\Repositories;

use App\Models\Surfista;
use App\Repositories\Contracts\SurfistaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SurfistaRepository implements SurfistaRepositoryInterface
{
    protected $surfista;

    public function __construct(Surfista $surfista)
    {
        $this->surfista = $surfista;
    }

    public function getAllSurfistas(): Collection
    {
        return $this->surfista->all();
    }

    public function getSurfistaById(int $id): ?Surfista
    {
        return $this->surfista->find($id);
    }

    public function createSurfista(array $data): Surfista
    {
        return $this->surfista->create($data);
    }

    public function updateSurfista(int $id, array $data): ?Surfista
    {
        $surfista = $this->surfista->find($id);

        if ($surfista) {
            $surfista->update($data);
            return $surfista;
        }

        return null;
    }

    public function deleteSurfista(int $id): bool
    {
        $surfista = $this->surfista->find($id);

        if ($surfista) {
            return $surfista->delete();
        }

        return false;
    }

    public function restoreSurfista(int $id): bool
    {
        $surfista = $this->surfista->withTrashed()->find($id);

        if ($surfista) {
            return $surfista->restore();
        }

        return false;
    }
}