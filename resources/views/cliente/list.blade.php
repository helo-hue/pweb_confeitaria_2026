@extends('main')
@section('titulo', 'Lista de Clientes')
@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Clientes</h2>
    <div class="d-flex gap-2">
        <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
        <a href="{{ route('clientes.create') }}" class="btn btn-novo">Novo Cliente</a>
    </div>
</div>

<form action="{{ route('clientes.index') }}" method="GET" class="mb-4 d-flex gap-2">
    <input type="text" name="buscar" class="form-control" placeholder="Pesquisar cliente..."
           value="{{ request('buscar') }}">
    <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
</form>

@if(session('erro'))
    <div class="alert alert-danger">{{ session('erro') }}</div>
@endif

@if(session('sucesso'))
    <div class="alert alert-success">{{ session('sucesso') }}</div>
@endif

<div class="row row-cols-5 g-3" id="clientesGrid">
    @foreach($dados as $index => $c)
    <div class="col cliente-card-wrapper" style="{{ $index >= 10 ? 'display:none;' : '' }}">
        <div class="produto-card">
            <div class="cliente-img-wrapper">
                <img src="{{ asset('storage/' . ($c->imagem ?? 'sem_imagem.png')) }}"
                     alt="{{ $c->nome }}">
            </div>
            <div class="produto-info">
                <h6>{{ $c->nome }}</h6>
                <p>📧 {{ $c->email }}</p>
                <p>📱 {{ $c->telefone }}</p>
                <p>📍 {{ $c->endereco ?? '-' }}</p>
                <p>🪪 {{ $c->cpf }}</p>
            </div>
            <div class="produto-acoes">
                <a href="{{ route('clientes.edit', $c->id) }}" class="btn btn-editar btn-sm">Editar</a>
                <form action="{{ route('clientes.destroy', $c->id) }}" method="POST"
                      onsubmit="return confirm('Excluir este cliente?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-excluir btn-sm">Excluir</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- CARD NOVO CLIENTE -->
    <div class="col cliente-card-wrapper" id="cardNovoCliente" style="display:none;">
        <a href="{{ route('clientes.create') }}" class="produto-card produto-card-novo text-decoration-none">
            <div class="cliente-img-wrapper">
                <div style="font-size:3rem;">👤</div>
            </div>
            <div class="produto-info">
                <h6>Cadastrar Novo Cliente</h6>
                <p>Clique para adicionar</p>
            </div>
        </a>
    </div>
</div>

@if($dados->count() > 10)
<div class="text-center mt-3">
    <button class="btn btn-novo" id="btnVerMais" onclick="verMais()">Ver Mais</button>
</div>
@endif

<script>
    const totalClientes = {{ $dados->count() }};
    let visiveis = 10;

    function verMais() {
        const cards = document.querySelectorAll('.cliente-card-wrapper');
        let mostrados = 0;

        cards.forEach((card) => {
            if (card.id === 'cardNovoCliente') return;
            if (card.style.display === 'none' && mostrados < 10) {
                card.style.display = '';
                mostrados++;
                visiveis++;
            }
        });

        if (visiveis >= totalClientes) {
            document.getElementById('cardNovoCliente').style.display = '';
            document.getElementById('btnVerMais').style.display = 'none';
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        if (totalClientes <= 10) {
            document.getElementById('cardNovoCliente').style.display = '';
        }
    });
</script>

@endsection