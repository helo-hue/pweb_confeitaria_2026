<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; color: #4a1010; }
        h1 { color: #8b1a1a; text-align: center; border-bottom: 2px solid #e85d5d; padding-bottom: 10px; }
        h2 { color: #8b1a1a; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #8b1a1a; color: white; padding: 10px; text-align: left; font-size: 0.85rem; }
        td { padding: 8px 10px; border-bottom: 1px solid #f4d0d0; font-size: 0.82rem; }
        tr:nth-child(even) td { background: #fff5f5; }
        .badge-ativo { background: #8b1a1a; color: white; padding: 3px 10px; border-radius: 12px; font-size: 0.75rem; }
        .badge-inativo { background: #f4a0a0; color: #8b1a1a; padding: 3px 10px; border-radius: 12px; font-size: 0.75rem; }
        .footer { text-align: center; margin-top: 40px; font-size: 0.75rem; color: #999; }
    </style>
</head>
<body>

    <h1>Maison Cerise — Relatório de Clientes</h1>

    <h2>Clientes Ativos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Pedidos</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientesAtivos as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td><span class="badge-ativo">{{ $cliente->pedidos_count }} pedido{{ $cliente->pedidos_count > 1 ? 's' : '' }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center; color:#999;">Nenhum cliente ativo.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Clientes Inativos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientesInativos as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td><span class="badge-inativo">Sem pedidos</span></td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center; color:#999;">Nenhum cliente inativo.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i') }} — Maison Cerise &copy; {{ now()->year }}
    </div>

</body>
</html>