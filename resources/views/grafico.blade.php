@extends('layouts.app')

@section('content')
<?php
$somacat = array();
$nomecat = array();
$desc = array();
$i = 0;
$j = 0;
?>
<div class="container-fluid">
    <div class="row justify-content-center mb-2">
        <a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/adicionar" class="btn btn-primary col-sm-2 mt-2 mr-1 font-weight-bold text-uppercase">Adicionar Transação</a>
        <a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/categoria" class="btn btn-secondary col-sm-2 mt-2 mr-1 font-weight-bold text-uppercase">Adicionar Categoria</a>
        <a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/pdf" class="btn btn-success col-sm-2 mt-2 mr-1 font-weight-bold text-uppercase" target="_blank">Gerar PDF</a>
    </div>
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status') && count($lista)>0)
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif
@if(count($lista)>0)
    <h2 class="text-center">Grafico por Categoria</h2>
@endif
    @foreach($usuarios as $item2)
        @if($item2->name == Auth::user()->name)
            @foreach($lista as $item)
                @if($item->id_user == $item2->id)
                    <?php
                        $somacat[$i] = $item->valor;
                        $nomecat[$i] = $item->nome_categoria." - ".$item->descricao;
                        $desc[$i] = $item->descricao;
                    ?>
                     <?php
                        $i++;
                    ?>
                @endif
             @endforeach
        @endif
    @endforeach



    <div class="col-sm-12">
    <div id="donutchart" style="width: 1200px; height: 500px; padding: 0; margin: 0;"></div>
    </div>
@endsection

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Categorias'],
      <?php
      for($i =0; $i < sizeof($somacat);$i++){

         ?>

        ['<?php echo $nomecat[$i];?>', <?php echo $somacat[$i];?>],

      <?php
      }
      ?>
    ]);

    var options = {
    pieHole: 0.4,
    pieStartAngle: 100,
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
  }
</script>
