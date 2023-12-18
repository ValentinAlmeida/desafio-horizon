<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurfistaValidateRequest extends FormRequest
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
            // A regra para o campo 'nome' é requerido, deve ser uma string e não pode ultrapassar 255 caracteres.
            'nome' => 'required|string|max:255',

            // A regra para o campo 'pais' é requerido, deve ser uma string e não pode ultrapassar 255 caracteres.
            'pais' => 'required|string|max:255',
        ];
    }
}