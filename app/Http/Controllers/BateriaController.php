<?php

namespace App\Http\Controllers;

use App\Models\Bateria;
use Illuminate\Http\Request;
use App\Models\Surfista;

class BateriaController extends Controller
{
    public function index()
    {
        return Bateria::all();
    }

    public function store(Request $request)
    {
        return Bateria::create($request->all());
    }

    public function show(Bateria $bateria)
    {
        return $bateria;
    }

    public function update(Request $request, Bateria $bateria)
    {
        $bateria->update($request->all());

        return $bateria;
    }

    public function destroy(Bateria $bateria)
    {
        $bateria->delete();

        return response()->json(null, 204);
    }

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
            // Em caso de empate, você pode implementar uma lógica para desempatar, se necessário.
            return "Empate";
        }
    }

    private function calcularPontuacao($surfistaId, $ondas)
    {
        $notasSurfista = [];

        foreach ($ondas as $onda) {
            // Verifica se a onda pertence ao surfista
            if ($onda->surfista_id == $surfistaId) {
                // Obtém a nota da onda (assume que há apenas uma nota por onda)
                $nota = $onda->nota->notaParcial1 + $onda->nota->notaParcial2 + $onda->nota->notaParcial3;

                // Adiciona a nota ao array
                $notasSurfista[] = $nota;
            }
        }

        // Ordena as notas em ordem decrescente
        rsort($notasSurfista);

        // Retorna a soma das duas maiores notas
        return array_sum(array_slice($notasSurfista, 0, 2));
    }
}
