<?php

namespace App\Http\Controllers;

use App\Models\Surfista;
use Illuminate\Http\Request;

/**
 * Controlador para gerenciar operações relacionadas aos surfistas.
 */
class SurfistaController extends Controller
{
    /**
     * Retorna todos os surfistas.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Surfista[]
     */
    public function index()
    {
        return Surfista::all();
    }

    /**
     * Armazena um novo surfista.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Surfista
     */
    public function store(Request $request)
    {
        return Surfista::create($request->all());
    }

    /**
     * Exibe os detalhes de um surfista específico.
     *
     * @param  \App\Models\Surfista  $surfista
     * @return \App\Models\Surfista
     */
    public function show(Surfista $surfista)
    {
        return $surfista;
    }

    /**
     * Atualiza os detalhes de um surfista existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surfista  $surfista
     * @return \App\Models\Surfista
     */
    public function update(Request $request, Surfista $surfista)
    {
        $surfista->update($request->all());

        return $surfista;
    }

    /**
     * Exclui um surfista específico.
     *
     * @param  \App\Models\Surfista  $surfista
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Surfista $surfista)
    {
        $surfista->delete();

        return response()->json(['message' => 'Deletado'], 204);
    }
}
