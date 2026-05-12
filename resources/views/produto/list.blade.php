@extends('main')
@section('titulo', 'Lista de produtos')
@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de produtos</h2>
    <div class="d-flex gap-2">
        <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
        <a href="{{ route('produtos.create') }}" class="btn btn-novo">Novo Produto</a>
    </div>
</div>

<form action="{{ route('produtos.index') }}" method="GET" class="mb-4 d-flex gap-2">
    <input type="text" name="buscar" class="form-control" placeholder="Pesquisar produto..."
           value="{{ request('buscar') }}">
    <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
</form>

@if(session('erro'))
    <div class="alert alert-danger">{{ session('erro') }}</div>
@endif

@if(session('sucesso'))
    <div class="alert alert-success">{{ session('sucesso') }}</div>
@endif

<div class="row row-cols-5 g-3" id="produtosGrid">
    @foreach($dados as $index => $b)
    <div class="col produto-card-wrapper" style="{{ $index >= 10 ? 'display:none;' : '' }}">
        <div class="produto-card">
            <div class="produto-img-wrapper">
                <img src="{{ asset('storage/' . ($b->imagem ?? 'sem_imagem.png')) }}"
                     alt="{{ $b->nome }}">
            </div>
            <div class="produto-info">
                <h6>{{ $b->nome }}</h6>
                <p>🎂 {{ $b->sabor_massa }}</p>
                <p>🍓 {{ $b->recheio }}</p>
                <p>✨ {{ $b->cobertura }}</p>
                <p class="produto-valor">R$ {{ number_format($b->valor, 2, ',', '.') }}</p>
            </div>
            <div class="produto-acoes">
                <a href="{{ route('produtos.edit', $b->id) }}" class="btn btn-editar btn-sm">Editar</a>
                <form action="{{ route('produtos.destroy', $b->id) }}" method="POST"
                      onsubmit="return confirm('Excluir este produto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-excluir btn-sm">Excluir</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- CARD NOVO BOLO -->
    <div class="col produto-card-wrapper" id="cardNovoBolo" style="display:none;">
        <a href="{{ route('produtos.create') }}" class="produto-card produto-card-novo text-decoration-none">
            <div class="produto-img-wrapper">
                <div style="font-size:3rem;">🍰</div>
            </div>
            <div class="produto-info">
                <h6>Cadastrar Novo Produto</h6>
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
    const totalprodutos = {{ $dados->count() }};
    let visiveis = 10;

    function verMais() {
        const cards = document.querySelectorAll('.produto-card-wrapper');
        let mostrados = 0;

        cards.forEach((card) => {
            if (card.id === 'cardNovoBolo') return;
            if (card.style.display === 'none' && mostrados < 10) {
                card.style.display = '';
                mostrados++;
                visiveis++;
            }
        });

        if (visiveis >= totalprodutos) {
            document.getElementById('cardNovoBolo').style.display = '';
            document.getElementById('btnVerMais').style.display = 'none';
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        if (totalprodutos <= 10) {
            document.getElementById('cardNovoBolo').style.display = '';
        }
    });
</script>

@endsection