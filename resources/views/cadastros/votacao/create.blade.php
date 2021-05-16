@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Votação') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       <form method="POST" action="{{route('Votacao.store')}}">
                           @csrf
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Titulo</label>
                               <input type="text" name="titulo" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Titulo da Votação" required>
                           </div>
                           <div class="mb-3">
                               <label for="inivotacao" class="form-label">Inicio da Votação</label>
                               <input type="datetime-local" name="inicio" class="form-control" id="inivotacao" required>
                           </div>
                           <div class="mb-3">
                               <label for="fimvotacao" class="form-label">Fim da Votação</label>
                               <input type="datetime-local" name="fim" class="form-control" id="fimvotacao" required>
                           </div>

                           <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection