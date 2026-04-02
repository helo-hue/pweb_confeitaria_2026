@extends('main')
@section('titulo', isset($bolo) ? 'Editar Bolo' : 'Novo Bolo')
@section('conteudo')

<h2 class="mb-4">{{ isset($bolo) ? 'Editar Bolo' : 'Novo Bolo' }}</h2>

<form action="{{ isset($bolo) ? route('bolos.update', $bolo->id) : route('bolos.store') }}" 
method="POST" 
enctype="multipart/form-data">

    @csrf
    @if(isset($bolo))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" value="{{ $bolo->nome ?? old('nome') }}" required>
    </div>

    <div class="mb-3">
        <label>Sabor da Massa:</label>
        <input type="text" name="sabor_massa" class="form-control" value="{{ $bolo->sabor_massa ?? old('sabor_massa') }}" required>
    </div>

    <div class="mb-3">
        <label>Recheio:</label>
        <input type="text" name="recheio" class="form-control" value="{{ $bolo->recheio ?? old('recheio') }}" required>
    </div>

    <div class="mb-3">
        <label>Cobertura:</label>
        <input type="text" name="cobertura" class="form-control" value="{{ $bolo->cobertura ?? old('cobertura') }}" required>
    </div>

    <div class="mb-3">
        <label>Valor (R$):</label>
        <input type="number" step="0.01" name="valor" class="form-control" value="{{ $bolo->valor ?? old('valor') }}" required>
    </div>

    <!-- IMAGEM -->
    <div class="mb-3">
        <label>Imagem</label><br>

        @php
            $img = isset($bolo) && $bolo->imagem ? $bolo->imagem : 'sem_imagem.png';
        @endphp

        <img src="{{ asset('storage/sem_imagem.png') }}"
             width="120"
             height="120"
             style="object-fit: cover; border-radius: 10px;">

        <input type="file" name="imagem" class="form-control mt-2">
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-novo">
            {{ isset($bolo) ? 'Atualizar' : 'Salvar' }}
        </button>

        <a href="{{ route('bolos.index') }}" class="btn btn-voltar">Voltar</a>
        <a href="{{ url('/') }}" class="btn btn-voltar">Início</a>
    </div>

</form>

@endsection