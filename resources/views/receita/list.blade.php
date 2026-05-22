@extends('main')
@section('titulo', 'Listagem de Receitas')
@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Receitas</h2>
    <div class="d-flex gap-2">
        <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
        <a href="{{ route('receitas.create') }}" class="btn btn-novo">Nova Receita</a>
    </div>
</div>

@if(session('sucesso'))
    <div class="alert alert-success">{{ session('sucesso') }}</div>
@endif

@if(session('erro'))
    <div class="alert alert-danger">{{ session('erro') }}</div>
@endif

<form action="{{ route('receitas.index') }}" method="GET" class="mb-4 d-flex gap-2">
    <input type="text" name="buscar" class="form-control"
           placeholder="Pesquisar receita..." value="{{ request('buscar') }}">
    <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
</form>

<div class="accordion" id="receitasAccordion">
    @foreach($dados as $index => $r)
    <div class="accordion-item mb-2 receita-item"
         style="border: 2px solid var(--cor-secundaria); border-radius: 12px; overflow: hidden; {{ $index >= 5 ? 'display:none;' : '' }}">

        <h2 class="accordion-header" style="background:none; box-shadow:none; padding:0; display:block;">
            <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#receita{{ $r->id }}">
                🍰 {{ $r->nome }}
                <span class="ms-auto me-3" style="font-size:0.75rem; color: var(--cor-terciaria);">
                    ⏱ {{ $r->tempo_preparo }}h &nbsp;|&nbsp; 🍽 {{ $r->rendimento }} porções
                </span>
            </button>
        </h2>

        <div id="receita{{ $r->id }}" class="accordion-collapse collapse">
            <div class="accordion-body" style="background: #fff5f5;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 style="color: var(--cor-primaria); font-weight:700;">🧂 Ingredientes</h6>
                        <p style="white-space: pre-line;">{{ $r->ingredientes }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 style="color: var(--cor-primaria); font-weight:700;">👩‍🍳 Modo de Preparo</h6>
                        <p style="white-space: pre-line;">{{ $r->modo_preparo }}</p>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('receitas.edit', $r->id) }}" class="btn btn-editar btn-sm">Editar</a>
                    <form action="{{ route('receitas.destroy', $r->id) }}" method="POST"
                          onsubmit="return confirm('Tem certeza?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-excluir btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>

@if($dados->count() > 5)
<div class="text-center mt-3">
    <button class="btn btn-novo" id="btnVerMais" onclick="verMaisReceitas()">Ver Mais</button>
</div>
@endif

<div id="config-receitas" data-total="{{ $dados->count() }}" style="display:none;"></div>

<script>
    let visiveisReceitas = 5;
    const totalReceitas = parseInt(document.getElementById('config-receitas').dataset.total);

    function verMaisReceitas() {
        const items = document.querySelectorAll('.receita-item');
        let mostrados = 0;

        items.forEach((item) => {
            if (item.style.display === 'none' && mostrados < 5) {
                item.style.display = '';
                mostrados++;
                visiveisReceitas++;
            }
        });

        if (visiveisReceitas >= totalReceitas) {
            document.getElementById('btnVerMais').style.display = 'none';
        }
    }
</script>

@endsection