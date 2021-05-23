@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Funcionários</h3></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       <form method="POST" action="{{route('Funcionarios.update',$funcionario->id)}}">
                           @csrf
                           @method('PUT')
                           <div class="mb-3">
                               <label for="formVotacao" class="form-label">Matricula</label>
                               <input type="text" value="{{$funcionario->matricula}}" name="matricula" class="form-control" id="formGroupExampleInput" placeholder="Digite a Matricula" required>
                           </div>
                           <div class="mb-3">
                               <label for="formVotacao" class="form-label">Nome</label>
                               <input type="text" value="{{$funcionario->nome}}" name="nome" class="form-control" id="formGroupExampleInput2" placeholder="Digite o Nome" required>
                           </div>
                           <div class="mb-3">
                               <label for="formVotacao" class="form-label">Cpf</label>
                               <input type="text" name="cpf" value="{{$funcionario->senha}}" class="form-control" id="formGroupExampleInput2" placeholder="Digite os 4 digitos do CPF" required>
                           </div>
                           <div class="mb-3">
                               <label for="formVotacao" class="form-label">Votação</label>
                               <select class="custom-select" name="votacao" required>
                                   <option selected disabled>Escolha a Votação</option>
                                   @foreach($votacoes as $votacao)
                                       <option value="{{$votacao->id}}"
                                       @if($votacao->id === $funcionario->votacao_id)
                                           selected
                                       @endif
                                       >{{$votacao->titulo}}</option>
                                   @endforeach
                               </select>
                           </div>


                           <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
