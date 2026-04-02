@extends('main')

@php
$semCabecalho = true;
@endphp

@section('titulo', 'Início')

@section('conteudo')

<div class="text-center">

<img src="{{ asset('storage/logomel&lavande.jpg') }}"
style="width:300px; border-radius:120px; margin-bottom:20px;">


<h2 class="mb-4">
Bem-vindo à Confeitaria Mel & Lavande
</h2>


<div class="mb-4">

<a href="{{ route('receitas.index') }}" class="btn btn-novo">
Receitas
</a>

<a href="{{ route('clientes.index') }}" class="btn btn-novo">
Clientes
</a>

<a href="{{ route('bolos.index') }}" class="btn btn-novo">
Bolos
</a>

<a href="{{ route('pedidos.index') }}" class="btn btn-novo">
Lista de Pedidos
</a>

<a href="{{ route('pedidos.create') }}" class="btn btn-novo">
Novo Pedido
</a>

</div>


<h3 class="mt-4">Últimos pedidos</h3>


<div class="table-responsive">

<table class="table table-custom">

<thead>

<tr>
<th>Cliente</th>
<th>Bolo</th>
<th>Kg</th>
<th>Total</th>
<th>Status</th>
</tr>

</thead>


<tbody>

@foreach($pedidos as $pedido)

<tr>



<td>{{ $pedido->cliente->nome }}</td>

<td>{{ $pedido->bolo->nome }}</td>

<td>{{ $pedido->quantidade }}</td>

<td>
R$ {{ number_format($pedido->valor_total,2,',','.') }}
</td>

<td>

@if($pedido->status == 'entregue')

<span class="status-entregue">
Entregue
</span>

@else

<span class="status-pendente">
Pendente
</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>


@endsection