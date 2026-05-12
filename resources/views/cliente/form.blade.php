@extends('main')
@section('titulo', isset($dado) ? 'Editar Cliente' : 'Cadastro de Cliente')
@section('conteudo')

<h2 class="mb-4">{{ isset($dado) ? 'Editar Cliente' : 'Cadastro de Cliente' }}</h2>

<form method="POST" enctype="multipart/form-data"
      action="{{ isset($dado) ? route('clientes.update', $dado->id) : route('clientes.store') }}">
    @csrf
    @if(isset($dado))
        @method('PUT')
    @endif

    <!-- FOTO -->
    <div class="mb-3 text-center">
        <img id="preview"
             src="{{ isset($dado) && $dado->imagem ? asset('storage/' . $dado->imagem) : asset('storage/sem_imagem.png') }}"
             style="width:120px; height:120px; object-fit:cover; border-radius:50%; border: 3px solid var(--cor-secundaria); margin-bottom:10px;">
        <div>
            <label class="btn btn-entregar btn-sm">
                📷 Escolher Foto
                <input type="file" name="imagem" accept="image/*" style="display:none;"
                       onchange="previewImagem(this)">
            </label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $dado->nome ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $dado->email ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="{{ $dado->telefone ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Endereço</label>
        <input type="text" name="endereco" class="form-control" value="{{ $dado->endereco ?? '' }}">
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">CPF</label>
        <input type="text" name="cpf" class="form-control" value="{{ $dado->cpf ?? '' }}" required>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-novo">{{ isset($dado) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-voltar">Voltar à Lista</a>
        <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
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