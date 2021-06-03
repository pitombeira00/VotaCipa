<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votos extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidato_id','funcionario_id','votacao_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'candidato_id'
    ];
    protected $table = 'votos';

    public function funcionario(){

        return $this->hasOne(Funcionarios::class, 'id', 'funcionario_id');
    }

    public function candidato(){

        return $this->hasOne(Candidatos::class, 'id', 'candidato_id');
    }

}
