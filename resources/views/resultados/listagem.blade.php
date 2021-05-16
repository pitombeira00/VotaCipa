@extends('layouts.login')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a class="btn btn-danger mb-3" href="{{ route('Votacao.index') }}">Retornar</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Resultados {{$id->titulo}}</div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th>Funcionario</th>
                                <th>Votação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($id->votos as $voto)
                                <tr>
                                    <td>{{$voto->funcionario->nome}}</td>
                                    <td>{{ \Carbon\Carbon::parse($voto->created_at )->format('d/m/Y - H:i:s')}}</td>
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
