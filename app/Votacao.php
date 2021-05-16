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
        'titulo','inicio','fim', 'titulo_slug'
    ];
    protected $table = 'votacao';

    public function candidatos(){

        return $this->hasMany(Candidatos::Class);

    }
}