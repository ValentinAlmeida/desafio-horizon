<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BateriaValidateRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtém as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // A regra para o campo 'surfista1' é requerido (deve ser fornecido) e deve existir na tabela 'surfistas' na coluna 'numero'.
            'surfista1' => 'required|exists:surfistas,numero',

            // A regra para o campo 'surfista2' é requerido, deve existir na tabela 'surfistas' na coluna 'numero' e deve ser diferente do valor do campo 'surfista1'.
            'surfista2' => 'required|exists:surfistas,numero|different:surfista1',
        ];
    }
}
