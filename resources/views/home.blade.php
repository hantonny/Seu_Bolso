@extends('layouts.app')

@section('content')
<?php 
$somad = 0;
$somar = 0;
?>
<div class="container">
<a href="http://localhost/controle_financeiro_laravel/transacao/public/adicionar" class="btn btn-primary">Adicionar Transação</a>
<a href="http://localhost/controle_financeiro_laravel/transacao/public/categoria" class="btn btn-secondary">Adicionar Categoria</a><br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h2>Lista de Transações</h2></div>
                <div class="card-body">
                    @if (session('status') && count($lista)>0)
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

@if(count($lista)>0)
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
      <font color='red'>Despesa</font>
      <?php 
      $somad = $somad + $item->valor;
      ?>
      @else
      <font color='green'>Receita</font>
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
      <td><a href="alterar/{{$item->id}}" class="btn btn-primary">Editar</a></td>
      <td><a href="delete/{{$item->id}}" class="btn btn-danger">Remover</a></td>
</tr>
@endif
@endforeach
@endif
@endforeach
  </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
    <br>
    <h3>Total de Receita: <span  class="text-success"><?php echo 'R$ ' . number_format($somar, 2, ',', '.'); ?></span></h3>
    <h3>Total de Despesas: <span class="text-danger"><?php echo '-R$ ' . number_format($somad, 2, ',', '.'); ?></span></h3>
</div>

@endsection
