@extends('layouts.login')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <a class="btn btn-success mb-3" href="{{ route('Votacao.create') }}">Inserir</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Votações') }}</div>

                    <div class="card-body">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Inicio</th>
                                <th>Fim</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($votacao as $voto)
                                <tr>
                                    <td>{{$voto->id}}</td>
                                    <td style="text-overflow: ellipsis;width: 12em">{{$voto->titulo}}</td>
                                    <td>{{ \Carbon\Carbon::parse($voto->inicio )->format('d/m/Y - H:i:s')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($voto->fim )->format('d/m/Y - H:i:s')}}</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" href="{{route('Votacao.edit',$voto)}}">Editar</a>
                                        <a class="btn btn-success btn-sm" href="{{route('candidatos.votacao',$voto)}}">Candidatos</a>
                                        <a class="btn btn-info btn-sm" target="_blank"  href="{{route('votar',$voto->titulo_slug)}}">Link de Votação</a>
                                        <a class="btn btn-outline-secondary btn-sm" target="_blank" href="{{route('externo.resultado',$voto->titulo_slug)}}">Resultado Externo</a>
                                        <a class="btn btn-warning btn-sm" href="{{route('votacao.dashboard',$voto)}}">Dashboard</a>
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
