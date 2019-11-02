<?php 
$somad = 0;
$somar = 0;
?>
<h1>Lista de Transações</h1>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@if(count($lista)>0)
@foreach($usuarios as $item2)
@if($item2->name == Auth::user()->name)
<h3>Usuário: {{$item2->name}}</h3>
@endif
@endforeach
<table class="table">
  <thead class="thead">
    <tr>
      <th scope="col">Tipo</th>
      <th scope="col">Valor</th>
      <th scope="col">Data</th>
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>
    </tr>
  </thead>
  <tbody>
@else
<h4>Não tem transações.</h4>
@endif
@foreach($usuarios as $item2)
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
</tr>
@endif
@endforeach
@endif
@endforeach
  </tbody>
</table>
<h3>Total de Receita: <span  class="text-success"><?php echo 'R$ ' . number_format($somar, 2, ',', '.'); ?></span></h3>
    <h3>Total de Despesas: <span class="text-danger"><?php echo '-R$ ' . number_format($somad, 2, ',', '.'); ?></span></h3>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>