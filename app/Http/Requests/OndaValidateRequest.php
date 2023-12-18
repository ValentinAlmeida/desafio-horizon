<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OndaValidateRequest extends FormRequest
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
            // A regra para o campo 'bateria_id' é requerido e deve existir na tabela 'baterias' na coluna 'id'.
            'bateria_id' => 'required|exists:baterias,id',

            // A regra para o campo 'surfista_id' é requerido e deve existir na tabela 'surfistas' na coluna 'numero'.
            'surfista_id' => 'required|exists:surfistas,numero',
        ];
    }
}
