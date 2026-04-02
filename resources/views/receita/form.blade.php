@extends('main')
@section('titulo', 'Formulário Receita')
@section('conteudo')

<h2 class="mb-4">Cadastro de Receita</h2>

<form method="post"
      action="{{ isset($dado) ? route('receitas.update',$dado->id) : route('receitas.store') }}">
    @csrf
    @if(isset($dado))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control"
               value="{{ $dado->nome ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Ingredientes</label>
        <textarea name="ingredientes" class="form-control" rows="4" required>{{ $dado->ingredientes ?? '' }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Modo de Preparo</label>
        <textarea name="modo_preparo" class="form-control" rows="4" required>{{ $dado->modo_preparo ?? '' }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tempo de Preparo (em horas)</label>
        <input type="number" name="tempo_preparo" class="form-control"
               value="{{ $dado->tempo_preparo ?? '' }}" step="0.1" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Rendimento (porções)</label>
        <input type="number" name="rendimento" class="form-control"
               value="{{ $dado->rendimento ?? '' }}" required>
    </div>

    <button type="submit" class="btn btn-novo">Salvar</button>
    <a href="{{ route('receitas.index') }}" class="btn btn-voltar ms-2">Voltar à Lista</a>
    <a href="{{ url('/') }}" class="btn btn-voltar ms-2">Voltar à Página Inicial</a>
</form>

@endsection