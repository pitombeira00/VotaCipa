<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'matricula', 'senha', 'votacao_id'
    ];
    protected $table = 'funcionarios';

    public function votacao(){

        return $this->belongsTo(Votacao::class);
    }
}
