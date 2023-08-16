@extends('adminlte::page')

@section('title', 'Hórus - Dashboard')

@section('content_header')

@endsection

@section('content')


<div class="card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <h3 class="card-title"><strong>ESTOQUE GERAL</strong></h3>
            <a href="javascript:void(0);">Gerar Relatório</a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <p class="d-flex flex-column">
                <span class="text-bold text-lg">Saldo Total R$ 185.230,00</span>
                <span>Período de 01/08/23 a 07/08/23</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 33.1%
                </span>
                <span class="text-muted">Desde o último mês</span>
            </p>
        </div>

        <div class="position-relative mb-4">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4">
                <canvas id="myChart4" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="col-sm-4">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="col-sm-4">
                <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
                <i class="fas fa-square text-success"></i> CC Primário
            </span>
            <span>
                <i class="fas fa-square text-danger"></i> CC Secundário
            </span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><strong>CENTRO DE CUSTOS PRIMÁRIO</strong></h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="#" class="dropdown-item">Ação</a>
                            <a href="#" class="dropdown-item">Outra ação</a>
                            <a href="#" class="dropdown-item">Outra ação</a>
                            <a class="dropdown-divider"></a>
                            <a href="#" class="dropdown-item">Link</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p>
                            <strong>Período: 1 Ago, 2023 - 15 Ago, 2023</strong>
                        </p>
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="myChart3" style="width:100%;max-width:600px"></canvas>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Metas</strong>
                        </p>
                        <div class="progress-group">
                            Meta 01
                            <span class="float-right"><b>160</b>/200</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            Meta 02
                            <span class="float-right"><b>310</b>/400</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            <span class="progress-text">Meta 03</span>
                            <span class="float-right"><b>480</b>/800</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: 60%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            Meta 04
                            <span class="float-right"><b>250</b>/500</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                            <h5 class="description-header">R$ 35.210,43</h5>
                            <span class="description-text">TOTAL ENTRADAS</span>
                        </div>
                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                            <h5 class="description-header">R$ 10.390,90</h5>
                            <span class="description-text">TOTAL SAÍDAS</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                            <h5 class="description-header">R$ 5.315,53</h5>
                            <span class="description-text">SAÍDAS MANUAIS</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                            <h5 class="description-header">R$ 24.813,53</h5>
                            <span class="description-text">SALDO CONSOLIDADO</span>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>



@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@stop

@section('js')
<script src="{{asset('js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    const xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
    const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

    new Chart("myChart", {
        type: "line"
        , data: {
            labels: xValues
            , datasets: [{
                fill: false
                , lineTension: 0
                , backgroundColor: "rgba(0,0,255,1.0)"
                , borderColor: "rgba(0,0,255,0.1)"
                , data: yValues
            }]
        }
        , options: {
            legend: {
                display: false
            }
            , scales: {
                yAxes: [{
                    ticks: {
                        min: 6
                        , max: 16
                    }
                }]
            , }
        }
    });

    const xValues2 = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

    new Chart("myChart2", {
        type: "line"
        , data: {
            labels: xValues2
            , datasets: [{
                data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478]
                , borderColor: "red"
                , fill: false
            }, {
                data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000]
                , borderColor: "green"
                , fill: false
            }, ]
        }
        , options: {
            legend: {
                display: false
            }
        }
    });

    var xValues3 = ["PRODUTO 01", "PRODUTO 02", "PRODUTO 03", "PRODUTO 04", "PRODUTO 05"];
    var yValues3 = [55, 49, 44, 24, 15];
    var barColors = [
        "#b91d47"
        , "#00aba9"
        , "#2b5797"
        , "#e8c3b9"
        , "#1e7145"
    ];

    new Chart("myChart3", {
        type: "doughnut"
        , data: {
            labels: xValues3
            , datasets: [{
                backgroundColor: barColors
                , data: yValues3
            }]
        }
        , options: {
            title: {
                display: true
                , text: "Produtos com maior saída"
            }
        }
    });

    var xValues4 = ["Saldo Anterior", "Entradas", "Saídas", "Estoque Atual", "Vendas (Manual)", "Saldo"];
    var yValues4 = [100, 50, 70, 80, 30, -40];
    var barColors4 = ["black", "green", "blue", "orange", "brown", "red"];

    new Chart("myChart4", {
        type: "bar"
        , data: {
            labels: xValues4
            , datasets: [{
                backgroundColor: barColors4
                , data: yValues4
            }]
        }
        , options: {
            legend: {
                display: false
            }
            , title: {
                display: true
                , text: ""
            }
        }
    });

</script>

<script>

</script>

@stop
