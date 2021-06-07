<?php

namespace App\Http\Controllers;

use App\Candidatos;
use App\Votacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidatosController extends Controller
{
    /**
     * Visualizar Candidatos por Votação
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPorVotacao(Votacao $id)
    {
        $candidatos = Candidatos::where('votacao_id',$id->id)->get();

        return view('cadastros.candidatos.home',compact('candidatos','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPorVotacao(Votacao $id)
    {

        return view('cadastros.candidatos.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('url')->isValid() ) {

            //Criar a Candidato

            $candidato = Candidatos::create([
                'nome' => $request->nome,
                'setor' => $request->setor,
                'url_foto' => '',
                'votacao_id' => $request->votacao_id
            ]);


            // Define uma pasta chamada Fotos
            $folder = 'public/Fotos';
            $folderExternp = '/Fotos';

            // Define um nome para o arquivo baseado no id_candidato
            $name = 'foto_candidato_'.trim($candidato->id);

            // Recupera a extensão do arquivo
            $extension = $request->url->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $request->url->storePubliclyAs($folder, $nameFile);


            //Salvo o Nome do Material no banco.
            $candidato->url_foto = $folderExternp.'/'.$nameFile;

            $candidato->save();
        }



        return redirect()->route('candidatos.votacao',$request->votacao_id)->with('status', 'Candidato Salvo com sucesso');

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

        $candidato = Candidatos::find($id);

        return view('cadastros.candidatos.edit',compact('candidato'));
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

        $candidato = Candidatos::find($id);

        $candidato->nome  = $request->nome;
        $candidato->setor = $request->setor;
        $candidato->url_foto = $request->url;

        $candidato->save();

        return redirect()->route('candidatos.votacao',$candidato->votacao_id)->with('status', 'Candidato Editado com sucesso');

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
}
