<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurfistaValidateRequest;
use App\Services\SurfistaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class SurfistaController extends Controller
{
    protected $surfistaService;

    public function __construct(SurfistaService $surfistaService)
    {
        $this->surfistaService = $surfistaService;
    }

    public function index(): Collection
    {
        return $this->surfistaService->getAllSurfistas();
    }

    public function store(SurfistaValidateRequest $request): JsonResponse
    {
        $surfista = $this->surfistaService->createSurfista($request->all());

        return response()->json($surfista, 201);
    }

    public function show(int $id): JsonResponse
    {
        $surfista = $this->surfistaService->getSurfistaById($id);

        if (!$surfista) {
            return response()->json(['message' => 'Surfista não encontrado'], 404);
        }

        return response()->json($surfista);
    }

    public function update(SurfistaValidateRequest $request, int $id): JsonResponse
    {
        $surfista = $this->surfistaService->updateSurfista($id, $request->all());

        return response()->json($surfista);
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->surfistaService->deleteSurfista($id);
    }

    public function restore(int $id): JsonResponse
    {
        return $this->surfistaService->restoreSurfista($id);
    }
}
