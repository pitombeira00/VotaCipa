@extends('layouts.votar')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Resultados {{$votacao->titulo}}</div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Cipeiro</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($votacao->candidatosGanhadores() as $candidato)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$candidato->nome}}</td>
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
