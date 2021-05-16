@extends('layouts.votar')

@section('style_css')
<style>
    input[type="radio"] {
        visibility: hidden;
    }

    label {
        display: block;
        border: 2px solid #666;
        width: 160px;
        float: left;
        margin-bottom: 10px;
    }

    input[type="radio"]:checked+label {
        border-color: #28a745;
        box-shadow: 2px 5px 5px gray;
    }
</style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Votação '.$votacao->titulo) }}</div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif


                        <div class="container">
                            <div class="row">
                                <p>Bem vindo a votação {{$votacao->titulo}}.
                                Informe sua matrícula, sua senha e escolha seu candidato.</p>

                                <form method="POST" action="{{route('votar.salvar')}}">
                                   @csrf
                                    <input type="hidden" value="{{$votacao->titulo_slug}}" name="votacao">
                                    <div class="mb-2">
                                        <input type="text" name="matricula" class="form-control" id="formGroupExampleInput" placeholder="Digite a sua Matricula" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="senha" class="form-control" id="formGroupExampleInput" placeholder="Digite a sua Senha" required>
                                    </div>

                                    @foreach($votacao->candidatos as $candidato)
                                        <div class="form-check form-check-inline m-2">
                                            <input class="form-check-input" type="radio" name="candidato" id="{{$candidato->id}}" value="{{$candidato->id}}">
                                            <label class="form-check-label" for="{{$candidato->id}}">
                                                <img src="{{$candidato->url_foto}}" class="img-thumbnail" style="width:150px" alt="...">
                                                <p class="text-center">{{$candidato->nome}}</p>
                                            </label>
                                        </div>
                                    @endforeach


                                    <button type="submit" class="btn btn-success btn-block m-2">Votar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
