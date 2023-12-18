<?php

namespace App\Repositories;

use App\Models\Nota;
use App\Repositories\Contracts\NotaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class NotaRepository implements NotaRepositoryInterface
{
    protected $nota;

    public function __construct(Nota $nota)
    {
        $this->nota = $nota;
    }

    public function getAllNotas(): Collection
    {
        return $this->nota->all();
    }

    public function getNotaById(int $id): ?Nota
    {
        return $this->nota->find($id);
    }

    public function createNota(array $data): Nota
    {
        return $this->nota->create($data);
    }

    public function updateNota(int $id, array $data): ?Nota
    {
        $nota = $this->nota->find($id);

        if ($nota) {
            $nota->update($data);
            return $nota;
        }

        return null;
    }

    public function deleteNota(int $id): bool
    {
        $nota = $this->nota->find($id);

        if ($nota) {
            return $nota->delete();
        }

        return false;
    }

    public function restoreNota(int $id): bool
    {
        $nota = $this->nota->withTrashed()->find($id);

        if ($nota) {
            return $nota->restore();
        }

        return false;
    }
}