<?php

namespace App\Http\Controllers;

use App\Models\Bateria;
use Illuminate\Http\Request;
use App\Models\Surfista;

/**
 * Controlador para gerenciar operações relacionadas às baterias de surf.
 */
class BateriaController extends Controller
{
    /**
     * Retorna todas as baterias.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Bateria[]
     */
    public function index()
    {
        return Bateria::all();
    }

    /**
     * Armazena uma nova bateria.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Bateria
     */
    public function store(Request $request)
    {
        return Bateria::create($request->all());
    }

    /**
     * Exibe os detalhes de uma bateria específica.
     *
     * @param  \App\Models\Bateria  $bateria
     * @return \App\Models\Bateria
     */
    public function show(Bateria $bateria)
    {
        return $bateria;
    }

    /**
     * Atualiza os detalhes de uma bateria existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bateria  $bateria
     * @return \App\Models\Bateria
     */
    public function update(Request $request, Bateria $bateria)
    {
        $bateria->update($request->all());

        return $bateria;
    }

    /**
     * Exclui uma bateria específica.
     *
     * @param  \App\Models\Bateria  $bateria
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Bateria $bateria)
    {
        $bateria->delete();

        return response()->json(['message' => 'Deletado'], 204);
    }

    /**
     * Obtém o surfista vencedor com base nas pontuações das ondas.
     *
     * @param  \App\Models\Bateria  $bateria
     * @return \App\Models\Surfista|string  Retorna o surfista vencedor ou "Empate".
     */
    public function getVencedor(Bateria $bateria)
    {
        $surfista1 = Surfista::find($bateria->surfista1);
        $surfista2 = Surfista::find($bateria->surfista2);
    
        $pontuacaoSurfista1 = $this->calcularPontuacao($surfista1->numero, $bateria->ondas);
        $pontuacaoSurfista2 = $this->calcularPontuacao($surfista2->numero, $bateria->ondas);
    
        if ($pontuacaoSurfista1 > $pontuacaoSurfista2) {
            return $surfista1;
        } elseif ($pontuacaoSurfista2 > $pontuacaoSurfista1) {
            return $surfista2;
        } else {
            return "Empate";
        }
    }
    
    /**
     * Calcula a pontuação total de um surfista com base nas ondas.
     *
     * @param  int  $surfistaId
     * @param  \Illuminate\Database\Eloquent\Collection  $ondas
     * @return float
     */
    private function calcularPontuacao($surfistaId, $ondas)
    {
        $pontuacao = 0;

        foreach ($ondas as $onda) {
            if ($onda->surfista_id == $surfistaId) {
                $mediaNota = ($onda->nota->notaParcial1 + $onda->nota->notaParcial2 + $onda->nota->notaParcial3) / 3;

                $pontuacao += $mediaNota;
            }
        }
        return $pontuacao;
    } 
}
