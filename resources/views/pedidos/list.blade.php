@extends('main')
@section('titulo', 'Lista de Pedidos')
@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Pedidos</h2>
    <a href="{{ route('pedidos.create') }}" class="btn btn-novo">
        Novo Pedido
    </a>
</div>


@if(session('sucesso'))
<div class="alert alert-success">
    {{ session('sucesso') }}
</div>
@endif


@if(session('erro'))
<div class="alert alert-danger">
    {{ session('erro') }}
</div>
@endif



<form action="{{ route('pedidos.index') }}" method="GET" class="mb-4 d-flex gap-2">

    <input type="text"
        name="buscar"
        class="form-control"
        placeholder="Buscar por cliente"
        value="{{ request('buscar') }}">

    <button type="submit" class="btn btn-pesquisar">
        Pesquisar
    </button>

</form>


<div class="table-responsive">

<table class="table table-custom align-middle">

<thead>

<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Bolo</th>
    <th>Quantidade</th>
    <th>Valor Total</th>
    <th>Data Pedido</th>
    <th>Data Entrega</th>
    <th>Pagamento</th>
    <th>Status</th>
    <th>Ações</th>
</tr>

</thead>


<tbody>

@foreach($pedidos as $pedido)

<tr>

<td>{{ $pedido->id }}</td>

<td>{{ $pedido->cliente->nome }}</td>

<td>{{ $pedido->bolo->nome }}</td>

<td>{{ $pedido->quantidade }}</td>

<td>
R$ {{ number_format($pedido->valor_total,2,',','.') }}
</td>

<td>{{ $pedido->data_pedido }}</td>

<td>{{ $pedido->data_entrega ?? '-' }}</td>

<td>{{ ucfirst($pedido->forma_pagamento) }}</td>


<!-- STATUS -->
<td>

@php
$hoje = date('Y-m-d');
@endphp


@if($pedido->status == 'entregue')

<span class="status-entregue">
Entregue
</span>


@elseif($pedido->data_entrega && $pedido->data_entrega < $hoje)

<span class="status-atrasado">
Atrasado
</span>


@else

<span class="status-pendente">
Pendente
</span>

@endif

</td>


<td class="d-flex gap-2">


<a href="{{ route('pedidos.edit', $pedido->id) }}"
class="btn btn-editar btn-sm">

Editar

</a>


@if($pedido->status == 'pendente')

<form action="{{ route('pedidos.entregar', $pedido->id) }}"
method="POST">

@csrf
@method('PUT')

<button type="submit"
class="btn btn-entregar btn-sm">

Entregar

</button>

</form>

@endif



<form action="{{ route('pedidos.destroy', $pedido->id) }}"
method="POST"
onsubmit="return confirm('Deseja excluir?')">

@csrf
@method('DELETE')

<button type="submit"
class="btn btn-excluir btn-sm">

Excluir

</button>

</form>


</td>

</tr>

@endforeach

</tbody>

</table>

</div>



<div class="mt-4">

<a href="{{ url('/') }}"
class="btn btn-voltar">

Voltar à Página Inicial

</a>

</div>


@endsection