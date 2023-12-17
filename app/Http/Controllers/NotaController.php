<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

/**
 * Controlador para gerenciar operações relacionadas às notas.
 */
class NotaController extends Controller
{
    /**
     * Retorna todas as notas.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Nota[]
     */
    public function index()
    {
        return Nota::all();
    }

    /**
     * Armazena uma nova nota.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Nota
     */
    public function store(Request $request)
    {
        return Nota::create($request->all());
    }

    /**
     * Exibe os detalhes de uma nota específica.
     *
     * @param  \App\Models\Nota  $nota
     * @return \App\Models\Nota
     */
    public function show(Nota $nota)
    {
        return $nota;
    }

    /**
     * Atualiza os detalhes de uma nota existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nota  $nota
     * @return \App\Models\Nota
     */
    public function update(Request $request, Nota $nota)
    {
        $nota->update($request->all());

        return $nota;
    }

    /**
     * Exclui uma nota específica.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();

        return response()->json(['message' => 'Deletado'], 204);
    }
}
