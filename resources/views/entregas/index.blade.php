@extends('main')

@section('titulo', 'Entregas')

@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Entregas</h2>
    <div class="d-flex gap-2">
        <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
        <a href="{{ route('entregas.calendario') }}" class="btn btn-novo">📅 Calendário</a>
    </div>
</div>

@if(session('sucesso'))
    <div class="alert alert-success">{{ session('sucesso') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-custom align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Itens</th>
                <th>Data Entrega</th>
                <th>Hora</th>
                <th>Retirador</th>
                <th>Endereço</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entregas as $entrega)
            <tr>
                <td>{{ $entrega->id }}</td>
                <td>{{ $entrega->pedido->cliente->nome }}</td>
                <td>
                    @foreach($entrega->pedido->itens as $item)
                        🍰 {{ $item->produto->nome }} ({{ $item->quantidade }} kg)<br>
                    @endforeach
                </td>
                <td>{{ $entrega->pedido->data_entrega ?? '-' }}</td>
                <td>{{ $entrega->hora_entrega ?? '-' }}</td>
                <td>{{ $entrega->nome_retirador ?? '-' }}</td>
                <td>{{ $entrega->endereco ?? '-' }}</td>
                <td>
                    @if($entrega->status == 'entregue')
                        <span class="status-entregue">Entregue</span>
                    @else
                        <span class="status-pendente">Pendente</span>
                    @endif
                </td>
                <td class="d-flex gap-2">
                    <a href="{{ route('entregas.edit', $entrega->id) }}" class="btn btn-editar btn-sm">Editar</a>
                    <form action="{{ route('entregas.destroy', $entrega->id) }}" method="POST"
                          onsubmit="return confirm('Deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-excluir btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection