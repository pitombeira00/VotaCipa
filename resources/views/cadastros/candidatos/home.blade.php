@extends('layouts.login')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Página inicial</a></li>
            <li class="breadcrumb-item"><a href="#">Eleição</a></li>
            <li class="breadcrumb-item active" aria-current="page">Candidatos</li>
        </ol>
    </nav>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card-header"><h3>{{$id->titulo}}</h3></div>
        
            <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a class="btn btn-success mb-3" href="{{ route('candidatos.incluir',$id) }}">Inserir</a>
                      <a class="btn btn-danger mb-3" href="{{ route('Votacao.index') }}">Retornar</a><br>
                      <small>Candidatos</small>
                    </div>

                    <div class="card-body">
                        <table id="tabela01" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
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
                                        <td><img src="{{url($candidato->url_foto)}}" class="img-thumbnail" style="width:150px; height: 150px" alt="...">
                                        </td>
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

@section('js')

    <script>
        $(document).ready( function () {
            $('#tabela01').DataTable({"language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese.json"
                }
            });
        } );
    </script>
@endsection
