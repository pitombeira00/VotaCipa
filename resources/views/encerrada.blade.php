@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Votação {{$votacao->titulo}} Encerrada</div>

                    <div class="card-body">
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Votação já encerrada!</h4>
                                O período desta votação era até {{ \Carbon\Carbon::parse($votacao->fim )->format('d/m/Y - H:i:s')}}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
