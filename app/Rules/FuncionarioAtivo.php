<?php

namespace App\Rules;

use App\Funcionarios;
use Illuminate\Contracts\Validation\Rule;

class FuncionarioAtivo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Funcionarios::where('matricula',$value)->where('deleted',false)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Matricula Bloqueada, Procure o Responsável ';
    }
}
