<?php

namespace App\Http\Controllers;

use App\Candidatos;
use App\Funcionarios;
use App\Http\Requests\VotacaoRequest;
use App\Votacao;
use App\Votos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VotacaoController extends Controller
{

    /**
     * Função da submissão do formulário da votação
     *
     * @param Request $request
     */
    public function voto(VotacaoRequest $request){

        //Validações
        $validacao = $this->validarFormularioVotacao($request);

        if($validacao){

            return redirect()->route('votar',$request->votacao)->withErrors($validacao);

        }

        $funcionario = Funcionarios::where('matricula',$request->matricula)->first();
        $votacao = Votacao::where('titulo_slug',$request->votacao)->first();

        Votos::create([
            'candidato_id' => $request->candidato,
            'funcionario_id' => $funcionario->id,
            'votacao_id' => $votacao->id,
        ]);


        return view('painel');

    }
    /**
     * Site da Votação
     *
     * @param $name
     */
    public function votacao($name){


        $votacao = Votacao::where('titulo_slug',$name)->first();


        if(empty($name) or empty($votacao)){
            abort(404);
        }


        return view('votar',compact('votacao'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votacao = Votacao::all();

        return view('cadastros.votacao.home',compact('votacao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastros.votacao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Votacao::create([
            'titulo' => $request->titulo,
            'inicio' => $request->inicio,
            'fim'    => $request->fim,
            'titulo_slug' => Str::slug($request->titulo)
        ]);


        return redirect()->route('Votacao.index')->with('status', 'Votação Salva com sucesso');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validarFormularioVotacao(Request $request)
    {
        //FUNCIONARIO é daquela votação VOTACAO
        //FUNCIONARIO X SENHA
        //FUNCIONARIO X SE JA VOTOU
        $arrayComErros = [];

        $votacao = Votacao::where('titulo_slug',$request->votacao)->first();

        //FUNCIONÁRIO NÃO ESTA VINCULADO A VOTACAO
        if(!Funcionarios::where('matricula',$request->matricula)->where('votacao_id',$votacao->id)->first()){

            array_push($arrayComErros,['FuncionarioXVotacao' =>'Matricula não é válida para essa votação']);

        }

        //VALIDA SENHA
        if(!Funcionarios::where('matricula',$request->matricula)->where('senha',$request->senha)->first() && empty($arrayComErros)){

            array_push($arrayComErros,['FuncionarioXSenha' =>'Senha informada está errada']);

        }
        //VALIDA SE JA VOTOU
        if(!Votos::where('funcionario_id',$request->matricula)->where('votacao_id',$votacao->id)->first() && empty($arrayComErros)){

            array_push($arrayComErros,['FuncionarioXSenha' =>'Matricula com Voto já realizado.']);

        }

        //dd($arrayComErros);
        return $arrayComErros;
    }
}
