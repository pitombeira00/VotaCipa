@extends('layouts.login')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a class="btn btn-success mb-3" href="{{ route('Funcionarios.create') }}">Inserir</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Funcionários') }}</div>

                    <div class="card-body">

                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nome</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($funcionarios as $funcionario)
                                    <tr>
                                        <td>{{$funcionario->matricula}}</td>
                                        <td>{{$funcionario->nome}}</td>
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
