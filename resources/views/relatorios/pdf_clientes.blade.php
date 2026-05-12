<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
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
        h2 {
            color: #8b1a1a;
            font-size: 13px;
            margin-top: 30px;
            border-left: 4px solid #8b1a1a;
            padding-left: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
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
        .badge-ativo {
            background: #2e7d32;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
        }
        .badge-inativo {
            background: #999;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
        }
        .resumo {
            margin-top: 10px;
            font-size: 11px;
            color: #555;
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

    <h1>Maison Cerise — Relatório de Clientes</h1>

    <p class="resumo">
        Clientes ativos: <strong>{{ $clientesComPedidos->count() }}</strong> &nbsp;|&nbsp;
        Clientes inativos: <strong>{{ $clientesSemPedidos->count() }}</strong>
    </p>

    <h2>Clientes Ativos (com pedidos)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Total de Pedidos</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientesComPedidos as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->pedidos->count() }} pedido(s)</td>
                <td><span class="badge-ativo">Ativo</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Clientes Inativos (sem pedidos)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Endereco</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientesSemPedidos as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->endereco ?? '-' }}</td>
                <td><span class="badge-inativo">Inativo</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i') }} — Maison Cerise © 2026
    </div>

</body>
</html>