@extends('main')
@section('titulo', isset($produto) ? 'Editar Produto' : 'Novo Produto')
@section('conteudo')

<h2 class="mb-4">{{ isset($produto) ? 'Editar Produto' : 'Novo Produto' }}</h2>

<form action="{{ isset($produto) ? route('produtos.update', $produto->id) : route('produtos.store') }}"
method="POST"
enctype="multipart/form-data">

    @csrf
    @if(isset($produto))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="fw-bold">Nome:</label>
        <input type="text" name="nome" class="form-control" value="{{ $produto->nome ?? old('nome') }}" required>
    </div>

    <div class="mb-3">
        <label class="fw-bold">Sabor da Massa:</label>
        <input type="text" name="sabor_massa" class="form-control" value="{{ $produto->sabor_massa ?? old('sabor_massa') }}" required>
    </div>

    <div class="mb-3">
        <label class="fw-bold">Recheio:</label>
        <input type="text" name="recheio" class="form-control" value="{{ $produto->recheio ?? old('recheio') }}" required>
    </div>

    <div class="mb-3">
        <label class="fw-bold">Cobertura:</label>
        <input type="text" name="cobertura" class="form-control" value="{{ $produto->cobertura ?? old('cobertura') }}" required>
    </div>

    <div class="mb-3">
        <label class="fw-bold">Valor (R$):</label>
        <input type="number" step="0.01" name="valor" class="form-control" value="{{ $produto->valor ?? old('valor') }}" required>
    </div>

    <!-- IMAGEM -->
    <div class="mb-3 text-center">
        <img id="preview"
             src="{{ isset($produto) && $produto->imagem ? asset('storage/' . $produto->imagem) : asset('storage/sem_imagem.png') }}"
             style="width:120px; height:120px; object-fit:contain; border-radius:12px; border: 2px solid var(--cor-secundaria); margin-bottom:10px;">
        <div>
            <label class="btn btn-entregar btn-sm">
                📷 Escolher Foto
                <input type="file" name="imagem" accept="image/*" style="display:none;"
                       onchange="previewImagem(this)">
            </label>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-novo">
            {{ isset($produto) ? 'Atualizar' : 'Salvar' }}
        </button>
        <a href="{{ route('produtos.index') }}" class="btn btn-voltar">Voltar</a>
        <a href="{{ url('/') }}" class="btn btn-voltar">Início</a>
    </div>

</form>

<script>
function previewImagem(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('preview').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection