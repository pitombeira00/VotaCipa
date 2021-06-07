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
                            <div class="row col-sm-12">
                                <p>Bem vindo a votação {{$votacao->titulo}}.
                                Informe sua matrícula, sua senha e escolha seu candidato.</p>

                                <form id="formu" action="{{route('votar.salvar')}}" method="POST">
                                   @csrf
                                    <input type="hidden" value="{{$votacao->titulo_slug}}" name="votacao">
                                    <div class="mb-2">
                                        <input type="text" name="matricula" class="form-control"  placeholder="Digite a sua Matricula" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="senha" class="form-control"  placeholder="Digite a sua Senha" required>
                                    </div>

                                    @foreach($votacao->candidatos as $candidato)
                                        <div class="form-check form-check-inline m-2">
                                            <input class="form-check-input" type="radio" name="candidato" id="{{$candidato->id}}" value="{{$candidato->id}}">
                                            <label class="form-check-label" for="{{$candidato->id}}">
                                                <img src="{{$candidato->url_foto}}" class="img-thumbnail" style="width:150px; height: 150px" alt="...">
                                                <p class="text-center">{{$candidato->nome}}</p>
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="col-12 ">
                                        {!! NoCaptcha::display(['data-size' => 'normal']) !!}

                                    </div>

                                    <a class="btn btn-success btn-block m-2" onclick="votar()">Confirmar</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.11/dist/sweetalert2.all.min.js" ></script>

<script>
    function votar(){
        Swal.fire({
            title: 'Deseja Confirmar?',
            text: "Deseja confirmar a sua votação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                $( "#formu" ).submit();

            }
        })

       // $( "#formu" ).submit();
    }
</script>
@endsection

