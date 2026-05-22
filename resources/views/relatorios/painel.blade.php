@extends('main')

@section('titulo', 'Painel Administrativo')

@section('conteudo')

<h2 class="mb-4">Painel Administrativo</h2>

<div class="row mt-4">

    <div class="col-md-6 mb-4">
        <div class="p-4 border rounded text-center" style="background:white;">
            <div style="font-size: 3rem;">📊</div>
            <h4 class="mt-3" style="color:#8b1a1a;">Análise Visual</h4>
            <p class="text-muted">Visualize gráficos de pedidos e produtos mais vendidos.</p>
            <a href="{{ route('relatorios.graficos') }}" class="btn btn-novo mt-2">Acessar</a>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="p-4 border rounded text-center" style="background:white;">
            <div style="font-size: 3rem;">📄</div>
            <h4 class="mt-3" style="color:#8b1a1a;">Exportar Relatório</h4>
            <p class="text-muted">Gere e exporte relatórios de pedidos em PDF.</p>
            <a href="{{ route('relatorios.pdf') }}" class="btn btn-novo mt-2">Exportar PDF</a>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="p-4 border rounded text-center" style="background:white;">
            <div style="font-size: 3rem;">👥</div>
            <h4 class="mt-3" style="color:#8b1a1a;">Clientes</h4>
            <p class="text-muted">Veja clientes ativos com pedidos e inativos sem pedidos.</p>
            <a href="{{ route('relatorios.clientes') }}" class="btn btn-novo mt-2">Exportar PDF</a>
        </div>
    </div>

<div class="col-md-6 mb-4">
    <div class="p-4 border rounded text-center" style="background:white;">
        <div style="font-size: 3rem;">🗓️</div>
        <h4 class="mt-3" style="color:#8b1a1a;">Entregas por Dia</h4>
        <p class="text-muted">Selecione um dia e exporte o relatório de entregas e retiradas.</p>
        <a href="{{ route('relatorios.entregas-dia') }}" class="btn btn-novo mt-2">Selecionar Dia</a>
    </div>
</div>iv>
    </div>

</div>

<div class="mt-2">
    <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
</div>

@endsection