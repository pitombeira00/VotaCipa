<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidatos extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome','setor','url_foto', 'votacao_id'
    ];
    protected $table = 'candidatos';

    public function votacao(){

        return $this->belongsTo(Votacao::class);
    }

    public function contagemVotosdoCandidato(){

      return  Votos::where('candidato_id',$this->id)->count();

    }
}
