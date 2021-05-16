<?php

namespace App\Http\Controllers;

use App\Votos;
use Illuminate\Http\Request;

class ResultadosController extends Controller
{

    public function index(){

        $votos = Votos::all();

        return view('resultados.home',compact('votos'));
    }
}
