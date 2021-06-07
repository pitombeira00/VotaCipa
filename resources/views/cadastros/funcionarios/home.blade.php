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
        <a class="btn btn-success mb-3" href="{{ route('Funcionarios.create') }}">Inserir</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Funcionários') }}</div>

                    <div class="card-body">

                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Matricula</th>
                                    <th>Nome</th>
                                    <th>Votação</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($funcionarios as $funcionario)
                                    <tr>
                                        <td>
                                            @if($funcionario->deleted)
                                                <span class="float-center badge bg-danger"><i class="fas fa-user-slash"></i></span>
                                            @else
                                                <span class="float-center badge bg-success"><i class="fas fa-user"></i></span>
                                            @endif
                                        </td>
                                        <td>{{$funcionario->matricula}}</td>
                                        <td>{{$funcionario->nome}}</td>
                                        <td>{{$funcionario->votacao->titulo}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{route('Funcionarios.edit',$funcionario)}}">Editar</a>
                                            @if($funcionario->deleted)
                                            <a class="btn btn-success btn-sm" href="{{route('Funcionarios.habilitar',$funcionario->id)}}">Habilitar</a>
                                            @else
                                                <a class="btn btn-danger btn-sm" href="{{route('Funcionarios.desabilitar',$funcionario->id)}}">Desabilitar</a>
                                            @endif
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
