@extends('layouts.app')

@section('content')
<?php 
$somacat1 = 0;
$somacat2 = 0;
$somacat3 = 0;
$somacat4 = 0;
$nomecat1 = "";
$nomecat2 = "";
$nomecat3 = "";
$nomecat4 = "";
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

@endif
    @foreach($usuarios as $item2)
        @if($item2->name == Auth::user()->name)
            @foreach($lista as $item)
                @if($item->id_user == $item2->id)
                    @foreach($categoria as $item3)
                        @if($item->nome_categoria == $item3->nome_categoria)
                            @switch($item3->id)
                                @case(1)
                                    <?php 
                                    $nomecat1 = $item->nome_categoria;
                                    $somacat1 = $somacat1 + $item->valor;
                                    ?>
                                @break
                                @case(2)
                                    <?php 
                                    $nomecat2 = $item->nome_categoria;
                                    $somacat2 = $somacat2 + $item->valor;
                                    ?>
                                @break
                                @case(3)
                                    <?php 
                                    $nomecat3 = $item->nome_categoria;
                                    $somacat3 = $somacat3 + $item->valor;
                                    ?>
                                @break
                                @default
                                    <?php 
                                    $nomecat4 = $item->nome_categoria;
                                    $somacat4 = $somacat4 + $item->valor;
                                    ?>
                            @endswitch
                        @endif
                    @endforeach
                @endif
             @endforeach
        @endif
    @endforeach
    <br>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Categorias'],
          ['<?php echo  $nomecat1;?>', <?php echo $somacat1;?>],
          ['<?php echo  $nomecat2;?>', <?php echo $somacat2;?>],
          ['<?php echo  $nomecat3;?>', <?php echo $somacat3;?>],
          ['<?php echo  $nomecat4;?>', <?php echo $somacat4;?>],
        ]);

        var options = {
        pieHole: 0.4,
        pieStartAngle: 100,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
</div>

@endsection
