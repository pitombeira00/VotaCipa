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
    protected $table = 'votos';

}
