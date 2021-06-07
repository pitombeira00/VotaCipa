@extends('layouts.login')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a class="btn btn-danger mb-3" href="{{ route('votacao.dashboard',$id) }}">Dashboard</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Resultados {{$id->titulo}}</div>
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
