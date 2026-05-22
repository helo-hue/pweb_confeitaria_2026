@extends('main')

@section('titulo', 'Lista de Pedidos')

@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Lista de Pedidos</h2>

    <div class="d-flex gap-2">

        <a href="{{ url('/') }}" class="btn btn-voltar">
            Voltar à Página Inicial
        </a>

        <a href="{{ route('pedidos.create') }}" class="btn btn-novo">
            Novo Pedido
        </a>

    </div>

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
<<<<<<< HEAD
    <th>produtos</th>
=======
    <th>Produtos</th>
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    <th>Quantidades</th>
    <th>Valor Total</th>
    <th>Data Pedido</th>
    <th>Data Entrega</th>
    <th>Pagamento</th>
    <th>Observações</th>
    <th>Status</th>
    <th>Ações</th>
</tr>
</thead>

<tbody>

@foreach($pedidos as $index => $pedido)

<<<<<<< HEAD
<tr class="pedido-linha"
    style="{{ $index >= 10 ? 'display:none;' : '' }}">
=======
<tr class="pedido-linha" {{ $index >= 10 ? 'hidden' : '' }}>
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89

    <td>{{ $pedido->id }}</td>

    <!-- CLIENTE -->
    <td>{{ $pedido->cliente->nome ?? 'Cliente não encontrado' }}</td>

<<<<<<< HEAD
    <!-- produtos -->
=======
    <!-- PRODUTOS -->
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    <td>
        @foreach($pedido->itens as $item)
            <div>🍰 {{ $item->produto->nome ?? 'Produto removido' }}</div>
        @endforeach
    </td>

    <!-- QUANTIDADE -->
    <td>
        @foreach($pedido->itens as $item)
            <div>{{ $item->quantidade }} kg</div>
        @endforeach
    </td>

    <!-- VALOR TOTAL -->
    <td>
<<<<<<< HEAD
        R$ {{ number_format($pedido->valor_total,2,',','.') }}
=======
        R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    </td>

    <td>{{ $pedido->data_pedido }}</td>

    <td>{{ $pedido->data_entrega ?? '-' }}</td>

    <td>{{ ucfirst($pedido->forma_pagamento) }}</td>

<<<<<<< HEAD
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

    <!-- AÇÕES -->
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

=======
    <!-- OBSERVAÇÕES -->
    <td>
        @foreach($pedido->itens as $item)
            <div>{{ $item->observacoes ?? '-' }}</div>
        @endforeach
    </td>

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

    <!-- AÇÕES -->
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

>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

@if($pedidos->count() > 10)

<div class="text-center mt-3">

    <button class="btn btn-novo"
            id="btnVerMais"
            onclick="verMaisPedidos()">
<<<<<<< HEAD

        Ver Mais

=======
        Ver Mais
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    </button>

</div>

@endif

<script>

    const totalPedidos = {{ $pedidos->count() }};
    let pedidosVisiveis = 10;

    function verMaisPedidos() {

        const linhas = document.querySelectorAll('.pedido-linha');
<<<<<<< HEAD

=======
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
        let mostrados = 0;

        linhas.forEach((linha) => {

<<<<<<< HEAD
            if (linha.style.display === 'none' && mostrados < 10) {

                linha.style.display = '';

                mostrados++;
                pedidosVisiveis++;

=======
            if (linha.hidden && mostrados < 10) {
                linha.hidden = false;
                mostrados++;
                pedidosVisiveis++;
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
            }

        });

        if (pedidosVisiveis >= totalPedidos) {
<<<<<<< HEAD

            document.getElementById('btnVerMais').style.display = 'none';

=======
            document.getElementById('btnVerMais').style.display = 'none';
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
        }

    }

</script>

@endsection