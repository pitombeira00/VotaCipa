<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votacao extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo','inicio','fim', 'titulo_slug','quantidade_ganhadores'
    ];
    protected $table = 'votacao';

    public function candidatos(){

        return $this->hasMany(Candidatos::Class);

    }
    public function votos(){

        return $this->hasMany(Votos::Class);

    }

    public function votacaoAtiva(){
        $dataAtual = date('Y-m-d H:s:i');

        return ($dataAtual > $this->inicio && $dataAtual < $this->fim);
    }

    public function naoIniciou(){
        $dataAtual = date('Y-m-d H:s:i');

        return ($dataAtual < $this->inicio );
    }
}
