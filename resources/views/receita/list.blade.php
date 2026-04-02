@extends('main')
@section('titulo', 'Listagem de Receitas')
@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Lista de Receitas</h2>

    <a href="{{ route('receitas.create') }}" class="btn btn-novo">
        Nova Receita
    </a>

</div>


{{-- MENSAGENS --}}

@if(session('sucesso'))

<div class="alert alert-success">
    {{ session('sucesso') }}
</div>

@endif


@if(session('erro'))

<div class="alert alert-danger">
    {{ session('erro') }}
</div>

@endif



<form action="{{ route('receitas.index') }}"
method="GET"
class="mb-4 d-flex gap-2">

<input type="text"
name="buscar"
class="form-control"
placeholder="Pesquisar receita..."
value="{{ request('buscar') }}">

<button type="submit"
class="btn btn-pesquisar">

Pesquisar

</button>

</form>



<div class="table-responsive">

<table class="table table-custom align-middle">

<thead>

<tr>

<th>ID</th>
<th>Nome</th>
<th>Ingredientes</th>
<th>Modo de Preparo</th>
<th>Tempo</th>
<th>Rendimento</th>
<th>Ações</th>

</tr>

</thead>

<tbody>

@foreach($dados as $r)

<tr>

<td>{{ $r->id }}</td>

<td>{{ $r->nome }}</td>

<td>{{ $r->ingredientes }}</td>

<td>{{ $r->modo_preparo }}</td>

<td>{{ $r->tempo_preparo }}</td>

<td>{{ $r->rendimento }}</td>


<td class="d-flex gap-2 justify-content-center">


<a href="{{ route('receitas.edit', $r->id) }}"
class="btn btn-editar btn-sm">

Editar

</a>


<form action="{{ route('receitas.destroy', $r->id) }}"
method="POST"
onsubmit="return confirm('Tem certeza?')">

@csrf
@method('DELETE')

<button type="submit"
class="btn btn-excluir btn-sm">

Excluir

</button>

</form>


</td>

</tr>

@endforeach

</tbody>

</table>


<a href="{{ url('/') }}"
class="btn btn-voltar mt-3">

Voltar à Página Inicial

</a>

</div>

@endsection