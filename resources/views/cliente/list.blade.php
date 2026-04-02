@extends('main')
@section('titulo', 'Lista de Clientes')
@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-novo">Novo Cliente</a>
</div>

<!-- Formulário de pesquisa -->
<form action="{{ route('clientes.index') }}" method="GET" class="mb-4 d-flex gap-2">
    <input type="text" name="buscar" class="form-control" placeholder="Pesquisar cliente..." value="{{ request('buscar') }}">
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
<!-- Tabela de clientes -->
<div class="table-responsive">
    <table class="table table-custom align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nome }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->telefone }}</td>
                <td>{{ $c->endereco }}</td>
                <td>{{ $c->cpf }}</td>
                <td class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('clientes.edit', $c->id) }}" class="btn btn-editar btn-sm">Editar</a>

                    <form action="{{ route('clientes.destroy', $c->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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