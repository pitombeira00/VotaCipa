@extends('layouts.login')

@section('content')
    <div class="container">
        <a class="btn btn-danger mb-3" href="{{ route('candidatos.votacao',$candidato->votacao_id) }}">Retornar</a>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Editar Candidato</h3>
                    <small>{{$candidato->votacao->titulo}}</small></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       <form method="post" action="{{route('Candidatos.update',$candidato->id)}}">
                           @method('PUT')
                           @csrf
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Nome</label>
                               <input type="text" name="nome" value="{{$candidato->nome}}" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Nome" required>
                           </div>
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Setor</label>
                               <input type="text" name="setor" value="{{$candidato->setor}}" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Setor" required>
                           </div>
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Link da Foto</label>
                               <input type="text" name="url" value="{{$candidato->url_foto}}" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Link da Foto" required>
                           </div>

                           <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
