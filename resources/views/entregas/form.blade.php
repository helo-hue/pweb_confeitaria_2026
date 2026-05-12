@extends('main')

@section('titulo', 'Editar Entrega')

@section('conteudo')

<h2 class="mb-4">Editar Entrega</h2>

<div class="mb-4 p-3 border rounded">
    <h5>Informações do Pedido</h5>
    <p><strong>Cliente:</strong> {{ $entrega->pedido->cliente->nome }}</p>
    <p><strong>Itens:</strong>
        @foreach($entrega->pedido->itens as $item)
            🍰 {{ $item->produto->nome }} ({{ $item->quantidade }} kg)
        @endforeach
    </p>
    <p><strong>Data de Entrega:</strong> {{ $entrega->pedido->data_entrega ?? '-' }}</p>
    <p><strong>Valor Total:</strong> R$ {{ number_format($entrega->pedido->valor_total, 2, ',', '.') }}</p>
</div>

<form action="{{ route('entregas.update', $entrega->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nome de quem vai retirar:</label>
        <input type="text" name="nome_retirador" class="form-control"
               value="{{ $entrega->nome_retirador ?? '' }}" placeholder="Nome do retirador">
    </div>

    <div class="mb-3">
        <label class="form-label">Endereço de Entrega:</label>
        <input type="text" name="endereco" class="form-control"
               value="{{ $entrega->endereco ?? '' }}" placeholder="Endereço completo">
    </div>

    <div class="mb-3">
        <label class="form-label">Hora da Entrega:</label>
        <input type="time" name="hora_entrega" class="form-control"
               value="{{ $entrega->hora_entrega ?? '' }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Status:</label>
        <select name="status" class="form-select">
            <option value="pendente" {{ $entrega->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="entregue" {{ $entrega->status == 'entregue' ? 'selected' : '' }}>Entregue</option>
        </select>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('entregas.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</form>

@endsection