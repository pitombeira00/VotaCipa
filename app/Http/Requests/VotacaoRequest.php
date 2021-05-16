<?php

namespace App\Http\Requests;

use App\Rules\Matricula;
use Illuminate\Foundation\Http\FormRequest;

class VotacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'matricula' => ['required', 'string', new Matricula()],
            'senha' => ['required','string','size:4'],
            'candidato' => ['required', 'numeric','size:1']
        ];
    }
}
