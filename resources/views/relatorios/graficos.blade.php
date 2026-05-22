@extends('main')

@section('titulo', 'Análise Visual')

@section('conteudo')

<h2 class="mb-4">Análise Visual</h2>

<div id="grafico-data"
    data-com-entrega="{{ $comEntrega }}"
    data-sem-entrega="{{ $semEntrega }}"
    data-produtos-labels="{{ json_encode($produtos->map(fn($i) => $i->produto->nome ?? 'Removido')) }}"
    data-produtos-valores="{{ json_encode($produtos->map(fn($i) => $i->total_quantidade)) }}"
></div>

<div class="row mt-4">

    <div class="col-md-6 mb-4">
        <div class="p-4 border rounded" style="background:white;">
            <h5 class="text-center mb-3">Pedidos com e sem Entrega</h5>
            <canvas id="graficoEntregas"></canvas>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="p-4 border rounded" style="background:white;">
            <h5 class="text-center mb-3">produtos Mais Pedidos (kg)</h5>
            <canvas id="graficoprodutos"></canvas>
        </div>
    </div>

</div>

<div class="mt-2">
    <a href="{{ route('relatorios.index') }}" class="btn btn-voltar">Voltar ao Painel</a>
    <a href="{{ url('/') }}" class="btn btn-voltar">Voltar à Página Inicial</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const data         = document.getElementById('grafico-data');
    const comEntrega   = parseInt(data.dataset.comEntrega);
    const semEntrega   = parseInt(data.dataset.semEntrega);
    const produtosLabels  = JSON.parse(data.dataset.produtosLabels);
    const produtosValores = JSON.parse(data.dataset.produtosValores);

    new Chart(document.getElementById('graficoEntregas'), {
        type: 'pie',
        data: {
            labels: ['Com Entrega', 'Sem Entrega'],
            datasets: [{
                data: [comEntrega, semEntrega],
                backgroundColor: ['#e85d5d', '#fdfdc9'],
                borderColor: ['#8b1a1a', '#f5c842'],
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    new Chart(document.getElementById('graficoprodutos'), {
        type: 'bar',
        data: {
            labels: produtosLabels,
            datasets: [{
                label: 'Total pedido (kg)',
                data: produtosValores,
                backgroundColor: [
                    '#e85d5d','#f5c842','#b8d4e8',
                    '#f4a0a0','#fdfdc9','#8b1a1a',
                    '#c8a96e','#e8d99a',
                ],
                borderColor: '#8b1a1a',
                borderWidth: 2,
                borderRadius: 8,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

@endsection