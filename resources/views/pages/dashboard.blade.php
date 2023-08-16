@extends('template.page')

@section('page_header')
@include('partials.header.default')
@endsection

@section('page_content')

<div class="card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <h3 class="card-title"><strong>PRODUTOS EM ESTOQUE</strong></h3>
            <a href="javascript:void(0);">Gerar Relatório</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table-bordered table-striped w-100 pd-10px">
            <thead>
                <tr>
                    <th class="p-1 text-center">Item</th>
                    <th class="p-1 w-40">Descrição</th>
                    <th class="p-1 text-center">Saldo Anterior</th>
                    <th class="p-1 text-center">Entradas</th>
                    <th class="p-1 text-center">Saídas Balcão</th>
                    <th class="p-1 text-center">Estoque Atual</th>
                    <th class="p-1 text-center">Vendas (Manual)</th>
                    <th class="p-1 text-center">Saldo Balcão</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="p-1 align-middle text-center">
                        {{ $key + 1 }}
                    </td>
                    <td class="p-1 align-middle">
                        {{ $item->description }}
                    </td>
                    <td class="p-1 align-middle text-center">
                        {{ $item->previousBalance }}
                    </td>
                    <td class="p-1 align-middle text-center">
                        {{ $item->entries }}
                    </td>
                    <td class="p-1 align-middle text-center">
                        {{ $item->outputs }}
                    </td>
                    <td class="p-1 align-middle text-center">
                        {{ $item->currentStock }}
                    </td>
                    <td class="p-1 align-middle text-center">
                        {{ $item->manualSales }}
                    </td>
                    <td class="p-1 align-middle text-center">
                        {{ $item->counterBalance }}
                    </td>
                </tr>
                @endforeach
                {{-- <tr>
                    <td colspan="2" class="align-middle text-right pr-12px">
                        <strong>VALOR TOTAL DA ENTRADA</strong>
                    </td>
                    <td class="align-middle text-center">
                    </td>
                    <td class="align-middle">
                    </td>
                </tr>  --}}
        </table>
    </div>
</div>


@endsection

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
