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


    public function votacaoDashboard(Votacao $id){

        $labels = [];
        foreach ($id->candidatosGanhadores() as $candidato){

            $colorR = mt_rand(0,255);
            $colorG = mt_rand(0,255);
            $colorB = mt_rand(0,255);

            array_push($labels,[
                "label" => $candidato->nome,
                'backgroundColor' => ['rgba('.$colorR.', '.$colorG.', '.$colorB.', 0.2)', 'rgba(54, 162, 235, 0.2)'],
                'data' => [$candidato->votos,0]
            ]);
        }
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels([$id->titulo])
            ->datasets($labels)
            ->options([]);

        if($id->totalFuncionarios() == 0){

            return redirect()->route('Votacao.index')->with('error', 'Sem Funcionário Vinculado');
        }
        return view('resultados.home',compact('chartjs','id'));
    }
    /**
     * Gráfico com o andamento da Votação
     *
     * @param Votacao $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resultadoPorVotacao(Votacao $id){

        $labels = [];
        foreach ($id->candidatos as $candidato){

            $colorR = mt_rand(0,255);
            $colorG = mt_rand(0,255);
            $colorB = mt_rand(0,255);

            array_push($labels,[
                "label" => $candidato->nome,
                'backgroundColor' => ['rgba('.$colorR.', '.$colorG.', '.$colorB.', 0.2)', 'rgba(54, 162, 235, 0.2)'],
                'data' => [$candidato->contagemVotosdoCandidato(),0]
            ]);
        }
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels([$id->titulo])
            ->datasets($labels)
            ->options([]);

        return view('resultados.grafico', compact('chartjs','id'));
    }

    /**
     * Listagem dos votos do funcionário
     *
     * @param Votacao $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function votacaoPorFuncionario(Votacao $id){

        return view('resultados.listagem', compact('id'));
    }

    /**
     * Função da submissão do formulário da votação
     *
     * @param Request $request
     */
    public function voto(VotacaoRequest $request){

        $funcionario = Funcionarios::where('matricula',$request->matricula)->first();
        $votacao = Votacao::where('titulo_slug',$request->votacao)->first();

        //Validações
        $validacao = $this->validarFormularioVotacao($request);

        if($validacao){

            return redirect()->route('votar',$request->votacao)->withErrors($validacao);

        }

        if( $votacao->votacaoAtiva()){

            Votos::create([
                'candidato_id' => $request->candidato,
                'funcionario_id' => $funcionario->id,
                'votacao_id' => $votacao->id,
            ]);


            return view('painel');

        }else{

            return view('encerrada',compact('votacao'));

        }


    }

    /**
     * Resultado da votacao com os Numero de votantes.
     *
     * @param $name
     */
    public function votacaoResultadoExterno($name){

        $votacao = Votacao::where('titulo_slug',$name)->first();
        $dataAtual = date('Y-m-s H:m:s');

        if(empty($name) or empty($votacao)){
            abort(404);
        }

        if( $votacao->votacaoAtiva()){

            return view('resultados.externo', compact('votacao'));


        }else{

            if($votacao->naoIniciou()){

                return view('naoiniciou',compact('votacao'));

            }else{

                return view('encerrada',compact('votacao'));

            }


        }
    }

    /**
     * Site da Votação
     *
     * @param $name
     */
    public function votacao($name){


        $votacao = Votacao::where('titulo_slug',$name)->first();
        $dataAtual = date('Y-m-s H:m:s');

        if(empty($name) or empty($votacao)){
            abort(404);
        }

        if( $votacao->votacaoAtiva()){

            return view('votar',compact('votacao'));

        }else{

            if($votacao->naoIniciou()){

                return view('naoiniciou',compact('votacao'));

            }else{

                return view('encerrada',compact('votacao'));

            }


        }



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
            'titulo_slug' => Str::slug($request->titulo),
            'quantidade_ganhadores' => $request->quantidade_ganhadores
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
        $votacao = Votacao::find($id);

        return view('cadastros.votacao.edit',compact('votacao'));

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
        $votacao = Votacao::find($id);

        $votacao->inicio = $request->inicio;
        $votacao->fim = $request->fim;
        $votacao->titulo = $request->titulo;
        $votacao->quantidade_ganhadores = $request->quantidade_ganhadores;
        $votacao->save();

        return redirect()->route('Votacao.index')->with('status', 'Votação Editada com sucesso');
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
        $funcionario = Funcionarios::where('matricula',$request->matricula)->where('votacao_id',$votacao->id)->first();

        //FUNCIONÁRIO NÃO ESTA VINCULADO A VOTACAO
        if(!Funcionarios::where('matricula',$request->matricula)->where('votacao_id',$votacao->id)->first()){

            array_push($arrayComErros,['FuncionarioXVotacao' =>'Matricula não é válida para essa votação']);

        }elseif(!Funcionarios::where('matricula',$request->matricula)->where('senha',$request->senha)->first() && empty($arrayComErros)){
            //VALIDA SENHA

            array_push($arrayComErros,['FuncionarioXSenha' =>'Senha informada está errada']);

        }elseif(Votos::where('funcionario_id',$funcionario->id)->where('votacao_id',$votacao->id)->first() && empty($arrayComErros)){
            //VALIDA SE JA VOTOU
            array_push($arrayComErros,['FuncionarioXSenha' =>'Matricula com Voto já realizado.']);

        }

        //dd($arrayComErros);
        return $arrayComErros;
    }

}
