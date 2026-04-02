@extends('main')
@section('titulo', isset($dado) ? 'Editar Cliente' : 'Cadastro de Cliente')
@section('conteudo')

<h2 class="mb-4">{{ isset($dado) ? 'Editar Cliente' : 'Cadastro de Cliente' }}</h2>

<form method="post" action="{{ isset($dado) ? route('clientes.update', $dado->id) : route('clientes.store') }}">
    @csrf
    @if(isset($dado))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $dado->nome ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $dado->email ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="{{ $dado->telefone ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Endereço</label>
        <input type="text" name="endereco" class="form-control" value="{{ $dado->endereco ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">CPF</label>
        <input type="text" name="cpf" class="form-control" value="{{ $dado->cpf ?? '' }}" required>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-novo">{{ isset($dado) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-voltar">Voltar à Lista</a>
        
    <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
</div>
    </div>
</form>

@endsection