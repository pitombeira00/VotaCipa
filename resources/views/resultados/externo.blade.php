@extends('layouts.votar')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Resultados {{$votacao->titulo}}</div>
                    <div class="card-body">
                        <div>
                            {!! $chartjs->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
