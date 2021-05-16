@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Inclusão Candidatos</h3>
                    <small>Inforamcado da votacao</small></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       <form method="POST" action="{{route('Candidatos.store')}}">
                           @csrf
                           <input type="hidden" name="votacao_id" value="{{$id->id}}">
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Nome</label>
                               <input type="text" name="nome" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Nome" required>
                           </div>
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Setor</label>
                               <input type="text" name="setor" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Setor" required>
                           </div>
                           <div class="mb-3">
                               <label for="formGroupExampleInput2" class="form-label">Link da Foto</label>
                               <input type="text" name="url" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Link da Foto" required>
                           </div>

                           <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
