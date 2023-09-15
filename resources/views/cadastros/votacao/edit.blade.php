@extends('layouts.login')

@section('content')
    <style>
        .container{
            margin: 0 auto;
        }

    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Página inicial</a></li>
            <li class="breadcrumb-item"><a href="#">Eleição</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Editar ').$votacao->titulo }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       <form method="POST" action="{{route('Votacao.update', $votacao->id)}}">
                           @csrf
                           @method('PUT')
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Titulo</label>
                               <input type="text" value="{{$votacao->titulo}}" name="titulo" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Titulo da Votação" required>
                           </div>
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Quantidade de Ganhadores</label>
                               <input type="number" value="{{$votacao->quantidade_ganhadores}}" name="quantidade_ganhadores" class="form-control" id="formGroupExampleInput2" placeholder="Digite a quantidade de Ganhadores" required>
                           </div>
                           <div class="mb-3">
                               <label for="inivotacao" class="form-label">Inicio da Votação</label>
                               <input value="{{str_replace(' ','T',$votacao->inicio)}}" type="datetime-local" name="inicio" class="form-control" id="inivotacao" required>
                           </div>
                           <div class="mb-3">
                               <label for="fimvotacao" class="form-label">Fim da Votação</label>
                               <input value="{{str_replace(' ','T',$votacao->fim)}}" type="datetime-local" name="fim" class="form-control" id="fimvotacao" required>
                           </div>

                           <button type="submit" class="btn btn-success mb-3">Confirmar</button>
                           <a class="btn btn-danger mb-3" href="{{ route('Votacao.index') }}">Cancelar</a>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
