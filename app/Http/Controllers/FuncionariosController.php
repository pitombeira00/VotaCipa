<?php

namespace App\Http\Controllers;

use App\Funcionarios;
use App\Votacao;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionarios::all();

        return view('cadastros.funcionarios.home',compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $votacoes  = Votacao::all();
        return view('cadastros.funcionarios.create', compact('votacoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Funcionarios::create([
            'nome' => $request->nome,
            'matricula' => $request->matricula,
            'senha' => $request->cpf,
            'votacao_id' => $request->votacao
        ]);

        return redirect()->route('Funcionarios.index')->with('status', 'Funcionário Salvo com sucesso');
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
        $funcionario = Funcionarios::find($id);
        $votacoes  = Votacao::all();

        return view('cadastros.funcionarios.edit',compact('funcionario','votacoes'));
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

         $funcionario = Funcionarios::find($id);

        $funcionario->nome = $request->nome;
        $funcionario->senha = $request->cpf;
        $funcionario->votacao_id = $request->votacao;
        $funcionario->matricula = $request->matricula;

        $funcionario->save();

        return redirect()->route('Funcionarios.index')->with('status', 'Funcionário Editado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $funcionario = Funcionarios::find($id);

        $funcionario->deleted = true;

        $funcionario->save();

        return redirect()->route('Funcionarios.index')->with('status', 'Funcionário Desabilitado com sucesso');

    }


    public function habilitar($id){

        $funcionario = Funcionarios::find($id);

        $funcionario->deleted = false;

        $funcionario->save();

        return redirect()->route('Funcionarios.index')->with('status', 'Funcionário Habilltado com sucesso');

    }

    public function desabilitar($id){

        $funcionario = Funcionarios::find($id);

        $funcionario->deleted = true;

        $funcionario->save();

        return redirect()->route('Funcionarios.index')->with('error', 'Funcionário Desabilitado com sucesso');

    }
}
