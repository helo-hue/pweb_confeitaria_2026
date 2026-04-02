@extends('main')
@section('titulo', isset($pedido) ? 'Editar Pedido' : 'Novo Pedido')
@section('conteudo')

<h2 class="mb-4">{{ isset($pedido) ? 'Editar Pedido' : 'Novo Pedido' }}</h2>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<form action="{{ isset($pedido) ? route('pedidos.update', $pedido->id) : route('pedidos.store') }}" method="POST">
    @csrf
    @if(isset($pedido))
        @method('PUT')
    @endif

    <!-- Cliente -->
    <div class="mb-3">
        <label class="form-label">Cliente:</label>
        <select name="cliente_id" id="clienteSelect" class="form-select" required>
            <option value="">Selecione</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ (isset($pedido) && $pedido->cliente_id == $cliente->id) ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Bolo -->
    <div class="mb-3">
        <label class="form-label">Bolo:</label>
        <select name="bolo_id" class="form-select" required>
            <option value="">Selecione</option>
            @foreach($bolos as $bolo)
                <option value="{{ $bolo->id }}" {{ (isset($pedido) && $pedido->bolo_id == $bolo->id) ? 'selected' : '' }}>
                    {{ $bolo->nome }} (R$ {{ number_format($bolo->valor,2,',','.') }})
                </option>
            @endforeach
        </select>
    </div>

    <!-- Quantidade -->
    <div class="mb-3">
        <label class="form-label">Quantidade (kg):</label>
        <input type="number" step="0.01" name="quantidade" id="quantidade" class="form-control"
               value="{{ $pedido->quantidade ?? old('quantidade') }}">
    </div>

    <!-- Quantidade por pessoas -->
    <div class="mb-3">
        <label class="form-label">Quantidade por pessoas (150g por pessoa)</label>
        <input type="number" id="pessoas" class="form-control" placeholder="Digite número de pessoas">
        <button type="button" class="btn btn-calcular mt-2" onclick="calcularQuantidade()">Calcular quantidade</button>
    </div>

    <!-- Data do Pedido -->
    <div class="mb-3">
        <label class="form-label">Data do Pedido:</label>
        <input type="date" name="data_pedido" class="form-control"
               value="{{ $pedido->data_pedido ?? old('data_pedido') }}" required>
    </div>

    <!-- Data de Entrega -->
    <div class="mb-3">
        <label class="form-label">Data de Entrega:</label>
        <input type="date" name="data_entrega" class="form-control"
               value="{{ $pedido->data_entrega ?? old('data_entrega') }}">
    </div>

    <!-- Forma de Pagamento -->
    <div class="mb-3">
        <label class="form-label">Forma de Pagamento:</label>
        <select name="forma_pagamento" class="form-select" required>
            @php $formas = ['dinheiro','débito','pix','crédito']; @endphp
            @foreach($formas as $forma)
                <option value="{{ $forma }}" {{ (isset($pedido) && $pedido->forma_pagamento == $forma) ? 'selected' : '' }}>
                    {{ ucfirst($forma) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label class="form-label">Status:</label>
        <select name="status" class="form-select">
            @php $status_opcoes = ['pendente','entregue']; @endphp
            @foreach($status_opcoes as $status)
                <option value="{{ $status }}" {{ (isset($pedido) && $pedido->status == $status) ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Botões -->
    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-novo">{{ isset($pedido) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('pedidos.index') }}" class="btn btn-voltar">Voltar à Lista</a>
        <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
    </div>
</form>

<!-- jQuery e Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
function calcularQuantidade() {
    let pessoas = document.getElementById('pessoas').value;
    if (pessoas > 0) {
        let kg = pessoas * 0.150;
        document.getElementById('quantidade').value = kg.toFixed(2);
    }
}

$(document).ready(function () {
    $('#clienteSelect').select2({
        placeholder: "Digite o nome do cliente",
        width: '100%'
    });
});
</script>

@endsection