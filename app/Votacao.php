<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function candidatosGanhadores(){

        return DB::table('votos')
                ->join('votacao', 'votacao.id', '=', 'votos.votacao_id')
                ->join('candidatos', 'candidatos.id', '=', 'votos.candidato_id')
                ->where('votacao.id',$this->id)
                ->select(DB::raw('count(*) as votos, candidatos.nome'))
                ->groupByRaw('candidato_id')
                ->orderByDesc('votos')
                ->limit($this->quantidade_ganhadores)
                ->get();
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
