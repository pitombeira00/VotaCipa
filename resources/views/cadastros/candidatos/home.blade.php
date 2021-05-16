@extends('layouts.login')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <a class="btn btn-success mb-3" href="{{ route('candidatos.incluir',$id) }}">Inserir</a>
        <a class="btn btn-danger mb-3" href="{{ route('Votacao.index') }}">Retornar</a>

            <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{$id->titulo}}</h3>
                    <small>Candidatos</small></div>

                    <div class="card-body">

                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Setor</th>
                                    <th>Foto</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($candidatos as $candidato)
                                    <tr>
                                        <td>{{$candidato->nome}}</td>
                                        <td>{{$candidato->setor}}</td>
                                        <td>{{$candidato->url_foto}}</td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href="#!">Excluir</a>
                                            <a class="btn btn-warning btn-sm" href="{{route('Candidatos.edit',$candidato)}}">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
