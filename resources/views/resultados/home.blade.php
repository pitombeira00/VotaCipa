@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Small boxes (Stat box) -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$id->totalFuncionarios()}}</h3>

                        <p>Total Votantes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('votacao.funcionarios',$id)}}" class="small-box-footer">Listagem de Votos <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{number_format(($id->totalVotos()/$id->totalFuncionarios())*100,2)}}<sup style="font-size: 20px">%</sup></h3>

                        <p>Validade Votação</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('resultado',$id)}}" class="small-box-footer">Ver Gráfico de Votos <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{($id->totalFuncionarios()-$id->totalVotos())}}</h3>

                        <p>Votos Faltantes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver Lista <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
        </div>
        <div class="row">
            <div class="card col-lg-12 col-12 shadow-lg">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Ganhadores
                    </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Gráfico</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Lista</a>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart"
                             style="position: relative; height: 300px;">
                            {!! $chartjs->render() !!}
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Cipeiro</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($id->candidatosGanhadores() as $candidato)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$candidato->nome}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
