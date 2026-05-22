@extends('main')

@section('titulo', 'Relatório de Entregas por Dia')

@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Entregas por Dia</h2>
    <a href="{{ route('relatorios.index') }}" class="btn btn-voltar">Voltar ao Painel</a>
</div>

<div class="p-4 border rounded" style="background:white; max-width:500px; margin: 40px auto; text-align:center;">
    <div style="font-size: 3rem;">🗓️</div>
    <h4 class="mt-3 mb-4" style="color:#8b1a1a;">Selecione o dia</h4>

    <form action="{{ route('relatorios.entregas-dia.pdf') }}" method="GET">
        <div class="mb-3">
            <input type="date"
                   name="data"
                   class="form-control"
                   value="{{ now()->addDay()->format('Y-m-d') }}"
                   required>
        </div>
        <button type="submit" class="btn btn-novo w-100">📄 Exportar PDF</button>
    </form>
</div>

@endsection