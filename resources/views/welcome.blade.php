@extends('main')

@php
$semCabecalho = true;
@endphp

@section('titulo', 'Início')

@section('conteudo')

<div class="text-center">

<img src="{{ asset('storage/logo.png') }}"
style="width:250px; border-radius:20px; margin-bottom:10px; display:block; margin-left:auto; margin-right:auto;">

<h2 class="mb-4">
Bem-vindo à Maison Cerise
</h2>

<div class="mb-4">
    <a href="{{ route('receitas.index') }}" class="btn btn-novo">Receitas</a>
    <a href="{{ route('clientes.index') }}" class="btn btn-novo">Clientes</a>
    <a href="{{ route('produtos.index') }}" class="btn btn-novo">produtos</a>
    <a href="{{ route('pedidos.index') }}" class="btn btn-novo">Lista de Pedidos</a>
    <a href="{{ route('pedidos.create') }}" class="btn btn-novo">Novo Pedido</a>
    <a href="{{ route('entregas.index') }}" class="btn btn-novo">Entregas</a>
    <a href="{{ route('relatorios.index') }}" class="btn btn-novo">Painel</a>
</div>

<h3 class="mt-4">Últimos pedidos</h3>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>produtos</th>
                <th>Total</th>
                <th>Data Entrega</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pedidos as $pedido)
            @php
                $hoje = \Carbon\Carbon::today();
                $dataEntrega = $pedido->data_entrega ? \Carbon\Carbon::parse($pedido->data_entrega) : null;
                $atrasado = $dataEntrega && $dataEntrega->lt($hoje) && $pedido->status != 'entregue';
            @endphp
            <tr>
                <td>{{ $pedido->cliente->nome }}</td>

                <td>
                    @foreach($pedido->itens as $item)
                        {{ $item->produto->nome }} ({{ $item->quantidade }} kg)<br>
                    @endforeach
                </td>

                <td>R$ {{ number_format($pedido->valor_total,2,',','.') }}</td>

                <td>
                    @if($dataEntrega)
                        {{ $dataEntrega->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if($pedido->status == 'entregue')
                        <span class="status-entregue">Entregue</span>

                    @elseif($atrasado)
                        <span class="status-atrasado">Atrasado</span>
                        <form action="{{ url('/pedidos/'.$pedido->id.'/entregar') }}" method="POST" class="d-inline mt-1">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-entregar mt-1">
                                Marcar Entregue
                            </button>
                        </form>

                    @else
                        <span class="status-pendente">Pendente</span>
                        <form action="{{ url('/pedidos/'.$pedido->id.'/entregar') }}" method="POST" class="d-inline mt-1">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-entregar mt-1">
                                Marcar Entregue
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection