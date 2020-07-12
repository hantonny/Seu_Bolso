@extends('layouts.app')

@section('content')
<?php
$somad = 0;
$somar = 0;
?>
<div class="container-fluid">
<div class="row justify-content-center mb-2">
<a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/adicionar" class="btn btn-primary col-sm-2 mt-2 mr-1 font-weight-bold text-uppercase">Adicionar Transação</a>
<a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/categoria" class="btn btn-secondary col-sm-2 mt-2 mr-1 font-weight-bold text-uppercase">Adicionar Categoria</a>
<a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/grafico" class="btn btn-warning col-sm-2 mt-2 mr-1 font-weight-bold text-uppercase">Gráfico por Categoria</a>
<a href="http://localhost/controle_financeiro_laravel/transacao_laravel/public/pdf" class="btn btn-success col-sm-2 mt-2 mr-1 font-weight-bold text-uppercase" target="_blank">Gerar PDF</a><br><br>
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
<div class="table-responsive col-12">
<table class="table">
  <thead class="thead">
    <tr>
      <th scope="col">Tipo</th>
      <th scope="col">Valor</th>
      <th scope="col">Data</th>
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>
      <th colspan="2">Acões</th>
    </tr>
  </thead>
  <tbody>
@else
<h4>Não tem transações.</h4>
@endif
@foreach($user as $item2)
@if($item2->name == Auth::user()->name)
@foreach($lista as $item)
@if($item->id_user == $item2->id)
<tr>
      <td>
      @if($item->tipo == 0)
      <font color='red' class="font-weight-bold">Despesa</font>
      <?php
      $somad = $somad + $item->valor;
      ?>
      @else
      <font color='green' class="font-weight-bold">Receita</font>
      <?php
      $somar = $somar + $item->valor;
      ?>
      @endif
      </td>
      <td>R$
      {{ number_format($item->valor, 2) }}
      </td>
      <td>
      {{ \Carbon\Carbon::parse($item->data_transacao)->format('d/m/Y')}}
      </td>
      <td>{{ $item->descricao}}</td>
      <td>
      {{$item->nome_categoria}}
      </td>
      <td><a href="alterar/{{$item->id}}" class="btn btn-primary text-uppercase font-weight-bold">Editar</a></td>
      <td><a href="delete/{{$item->id}}" class="btn btn-danger text-uppercase font-weight-bold" onclick="return confirm('Tem certeza que deseja excluir?')">Remover</a></td>
</tr>
@endif
@endforeach
@endif
@endforeach
  </tbody>
</table>
<div class="col-12">
<h3 class="text-center mt-2">Total de Receita: <span  class="text-success"><?php echo 'R$ ' . number_format($somar, 2, ',', '.'); ?></span> /
Total de Despesas: <span class="text-danger"><?php echo '-R$ ' . number_format($somad, 2, ',', '.'); ?></span> /
Total de Sombra: <span class="text-primary"><?php
$sobra = $somar - $somad;
 echo ' R$ ' . number_format($sobra, 2, ',', '.');
 ?></span>
 </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
