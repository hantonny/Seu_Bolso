@extends('layouts.app')

@section('content')
<?php
$somacat = array();
$nomecat = array();
$desc = array();
$i = 0;
$j = 0;
?>
<div class="container">
<a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/adicionar" class="btn btn-primary">Adicionar Transação</a>
<a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/categoria" class="btn btn-secondary">Adicionar Categoria</a>
<a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/pdf" class="btn btn-success" target="_blank">Gerar PDF</a><br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h2>Grafico por Categoria</h2></div>
                <div class="card-body">
                    @if (session('status') && count($lista)>0)
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif
@if(count($lista)>0)
<table class="table table-sm col-4">
  <thead class="thead">
        <tr>
        <th scope="col">Categoria</th>
        <th scope="col">Descrição</th>
        <th scope="col">Valor</th>
        </tr>
    </thead>
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
                         <tbody>
                            <tr>
                            <td><?php  echo $nomecat[$i];?></td>
                            <td><?php  echo $desc[$i];?></td>
                            <td><?php  echo "R$ ".number_format($somacat[$i],2);?></td>
                            </tr>
                     <?php
                        $i++;
                    ?>
                @endif
             @endforeach
        @endif
    @endforeach
    </tbody>
</table>
    <br>
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
    <div id="donutchart" style="width: 800px; height: 500px;"></div>
</div>
@endsection
