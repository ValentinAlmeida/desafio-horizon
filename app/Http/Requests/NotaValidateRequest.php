<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaValidateRequest extends FormRequest
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
            // A regra para o campo 'onda_id' é requerido e deve existir na tabela 'ondas' na coluna 'id'.
            'onda_id' => 'required|exists:ondas,id',

            // As regras para os campos 'notaParcial1', 'notaParcial2' e 'notaParcial3' são requeridos, devem ser numéricos e estar dentro do intervalo de 0 a 10.
            'notaParcial1' => 'required|numeric|min:0|max:10',
            'notaParcial2' => 'required|numeric|min:0|max:10',
            'notaParcial3' => 'required|numeric|min:0|max:10',
        ];
    }
}
