@extends('main')

@section('titulo', isset($pedido) ? 'Editar Pedido' : 'Novo Pedido')

@section('conteudo')

<h2 class="mb-4">{{ isset($pedido) ? 'Editar Pedido' : 'Novo Pedido' }}</h2>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div id="app-data"
    data-produtos="{{ json_encode($produtos->map(fn($b) => ['id' => $b->id, 'nome' => $b->nome, 'valor' => $b->valor])) }}"
    data-itens="{{ json_encode(isset($pedido) ? $pedido->itens->map(fn($i) => ['produto_id' => $i->produto_id, 'quantidade' => $i->quantidade, 'observacoes' => $i->observacoes ?? '']) : []) }}"
></div>

<form action="{{ isset($pedido) ? route('pedidos.update', $pedido->id) : route('pedidos.store') }}" method="POST">
    @csrf
    @if(isset($pedido))
        @method('PUT')
    @endif

    <!-- CLIENTE -->
    <div class="mb-3">
        <label class="form-label fw-bold">Cliente:</label>
        <select name="cliente_id" id="clienteSelect" class="form-select" required>
            <option value="">Selecione</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                    {{ (isset($pedido) && $pedido->cliente_id == $cliente->id) ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- ITENS (produtos) -->
    <div class="mb-3">
        <label class="form-label fw-bold">produtos do Pedido:</label>
        <div id="itensPedido"></div>
        <button type="button" class="btn btn-entregar mt-2" onclick="adicionarBolo()">
            + Adicionar Produto
        </button>
    </div>

    <!-- DATA PEDIDO -->
    <div class="mb-3">
        <label class="form-label fw-bold">Data do Pedido:</label>
        <input type="date" name="data_pedido" class="form-control"
               value="{{ $pedido->data_pedido ?? old('data_pedido') }}" required>
    </div>

    <!-- DATA ENTREGA -->
    <div class="mb-3">
        <label class="form-label fw-bold">Data de Entrega:</label>
        <input type="date" name="data_entrega" class="form-control"
               value="{{ $pedido->data_entrega ?? old('data_entrega') }}">
    </div>

    <!-- PAGAMENTO -->
    <div class="mb-3">
        <label class="form-label fw-bold">Forma de Pagamento:</label>
        <select name="forma_pagamento" class="form-select" required>
            @php $formas = ['dinheiro','débito','pix','crédito']; @endphp
            @foreach($formas as $forma)
                <option value="{{ $forma }}"
                    {{ (isset($pedido) && $pedido->forma_pagamento == $forma) ? 'selected' : '' }}>
                    {{ ucfirst($forma) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- STATUS -->
    <div class="mb-3">
        <label class="form-label fw-bold">Status:</label>
        <select name="status" class="form-select">
            @php $status_opcoes = ['pendente','entregue']; @endphp
            @foreach($status_opcoes as $status)
                <option value="{{ $status }}"
                    {{ (isset($pedido) && $pedido->status == $status) ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- TEM ENTREGA -->
    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" name="tem_entrega" id="tem_entrega" class="form-check-input" value="1"
                   {{ (isset($pedido) && $pedido->tem_entrega) ? 'checked' : '' }}>
            <label class="form-check-label fw-bold" for="tem_entrega">
                🚚 Este pedido tem entrega? <small class="text-muted">(+ R$ 15,00)</small>
            </label>
        </div>
    </div>

    <!-- BOTÕES -->
    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-novo">
            {{ isset($pedido) ? 'Atualizar' : 'Salvar' }}
        </button>
        <a href="{{ route('pedidos.index') }}" class="btn btn-voltar">Voltar à Lista</a>
        <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    const appData = document.getElementById('app-data');
    const produtos   = JSON.parse(appData.dataset.produtos);
    const itens   = JSON.parse(appData.dataset.itens);

    let produtoCount = 0;

    function buildprodutosOptions() {
        return produtos.map(b =>
            `<option value="${b.id}">${b.nome} (R$ ${parseFloat(b.valor).toFixed(2).replace('.', ',')})</option>`
        ).join('');
    }

    function adicionarBolo(produtoId = null, quantidade = null, observacoes = '') {
        const index = produtoCount++;
        const div   = document.createElement('div');
        div.classList.add('p-3', 'mb-2', 'rounded', 'item-produto', 'border');

        div.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <label class="fw-bold">Produto:</label>
                    <select name="itens[${index}][produto_id]" class="form-select produto-select" required>
                        <option value="">Selecione</option>
                        ${buildprodutosOptions()}
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="fw-bold">Quantidade (kg):</label>
                    <input type="number" step="0.01" name="itens[${index}][quantidade]"
                           class="form-control" value="${quantidade ?? ''}" required>
                </div>
                <div class="col-md-4">
                    <label class="fw-bold">Observações:</label>
                    <input type="text" name="itens[${index}][observacoes]"
                           class="form-control" placeholder="Opcional" value="${observacoes}">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-excluir"
                        onclick="this.closest('.item-produto').remove()">X</button>
                </div>
            </div>
        `;

        document.getElementById('itensPedido').appendChild(div);

        if (produtoId) {
            div.querySelector('.produto-select').value = produtoId;
        }
    }

    $(document).ready(function () {
        $('#clienteSelect').select2({
            placeholder: "Digite o nome do cliente",
            width: '100%'
        });

        itens.forEach(item => {
            adicionarBolo(item.produto_id, item.quantidade, item.observacoes);
        });
    });
</script>

@endsection