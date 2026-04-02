@extends('main')
@section('titulo', 'Lista de Bolos')
@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Bolos</h2>
    <a href="{{ route('bolos.create') }}" class="btn btn-novo">Novo Bolo</a>
</div>

<!-- Formulário de pesquisa -->
<form action="{{ route('bolos.index') }}" method="GET" class="mb-4 d-flex gap-2">
    <input type="text" name="buscar" class="form-control" placeholder="Pesquisar bolo..." value="{{ request('buscar') }}">
    <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
</form>

@if(session('erro'))
<div class="alert alert-danger">
{{ session('erro') }}
</div>
@endif

@if(session('sucesso'))
<div class="alert alert-success">
{{ session('sucesso') }}
</div>
@endif

<!-- Tabela de bolos -->
<div class="table-responsive">
    <table class="table table-custom align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th> 
                <th>Nome</th>
                <th>Massa</th>
                <th>Recheio</th>
                <th>Cobertura</th>
                <th>Valor (R$)</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $b)
            <tr>
                <td>{{ $b->id }}</td>

                
                <td>
                    <img src="{{ asset('storage/' . ($b->imagem ?? 'sem_imagem.png')) }}"
     width="60"
     height="60"
     style="object-fit: cover; border-radius: 10px;">
                </td>

                <td>{{ $b->nome }}</td>
                <td>{{ $b->sabor_massa }}</td>
                <td>{{ $b->recheio }}</td>
                <td>{{ $b->cobertura }}</td>
                <td>{{ number_format($b->valor, 2, ',', '.') }}</td>

                <td class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('bolos.edit', $b->id) }}" class="btn btn-editar btn-sm">Editar</a>

                    <form action="{{ route('bolos.destroy', $b->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-excluir btn-sm">Excluir</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
</div>

@endsection