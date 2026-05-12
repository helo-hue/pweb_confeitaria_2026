<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #2a1f0e;
        }
        h1 {
            text-align: center;
            color: #8b1a1a;
            border-bottom: 2px solid #8b1a1a;
            padding-bottom: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #8b1a1a;
            color: white;
            padding: 8px;
            text-align: left;
        }
        td {
            padding: 6px 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) td {
            background: #fdfdc9;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Maison Cerise — Relatório de Pedidos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>produtos</th>
                <th>Valor Total</th>
                <th>Data Pedido</th>
                <th>Data Entrega</th>
                <th>Pagamento</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->cliente->nome ?? '-' }}</td>
                <td>
                    @foreach($pedido->itens as $item)
                        {{ $item->produto->nome ?? '-' }} ({{ $item->quantidade }}kg)
                    @endforeach
                </td>
                <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                <td>{{ $pedido->data_pedido }}</td>
                <td>{{ $pedido->data_entrega ?? '-' }}</td>
                <td>{{ ucfirst($pedido->forma_pagamento) }}</td>
                <td>{{ ucfirst($pedido->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i') }} — Maison Cerise © 2026
    </div>
</body>
</html>