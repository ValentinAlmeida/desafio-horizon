<?php

namespace App\Http\Controllers;

use App\Models\Onda;
use Illuminate\Http\Request;

/**
 * Controlador para gerenciar operações relacionadas às ondas.
 */
class OndaController extends Controller
{
    /**
     * Retorna todas as ondas.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Onda[]
     */
    public function index()
    {
        return Onda::all();
    }

    /**
     * Armazena uma nova onda.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Onda
     */
    public function store(Request $request)
    {
        return Onda::create($request->all());
    }

    /**
     * Exibe os detalhes de uma onda específica.
     *
     * @param  \App\Models\Onda  $onda
     * @return \App\Models\Onda
     */
    public function show(Onda $onda)
    {
        return $onda;
    }

    /**
     * Atualiza os detalhes de uma onda existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Onda  $onda
     * @return \App\Models\Onda
     */
    public function update(Request $request, Onda $onda)
    {
        $onda->update($request->all());

        return $onda;
    }

    /**
     * Exclui uma onda específica.
     *
     * @param  \App\Models\Onda  $onda
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Onda $onda)
    {
        $onda->delete();

        return response()->json(['message' => 'Deletado'], 204);
    }
}
