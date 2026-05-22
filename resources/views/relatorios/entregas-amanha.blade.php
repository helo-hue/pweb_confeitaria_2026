<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; color: #4a1010; margin: 30px; }

        h1 { color: #8b1a1a; text-align: center; border-bottom: 2px solid #e85d5d; padding-bottom: 10px; }

        .secao-titulo {
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            margin: 24px 0 10px;
        }

        .titulo-entrega  { background: #e85d5d; }
        .titulo-retirada { background: #3b82f6; }

        table { width: 100%; border-collapse: collapse; margin-top: 6px; }

        th { padding: 10px; text-align: left; font-size: 0.82rem; color: white; }
        .th-entrega  { background: #e85d5d; }
        .th-retirada { background: #3b82f6; }

        td { padding: 8px 10px; border-bottom: 1px solid #f4d0d0; font-size: 0.8rem; }
        tr:nth-child(even) td { background: #fff5f5; }

        .badge {
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .badge-entrega  { background: #e85d5d; color: white; }
        .badge-retirada { background: #3b82f6; color: white; }

        .footer { text-align: center; margin-top: 40px; font-size: 0.75rem; color: #999; }

        .vazio { text-align: center; color: #999; padding: 16px; }

        .resumo {
            display: flex;
            gap: 20px;
            margin: 16px 0;
        }

        .resumo-box {
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <h1>Maison Cerise — Entregas do Dia</h1>
    <p style="text-align:center; color:#8b1a1a; font-size:1rem; margin-top:-10px;">
      
{{ \Carbon\Carbon::parse($data)->translatedFormat('l, d \d\e F \d\e Y') }}
    </p>

    {{-- RESUMO --}}
    <table style="width:auto; margin: 16px auto;">
        <tr>
            <td style="padding: 8px 20px; background:#e85d5d; color:white; border-radius:8px; font-weight:bold; text-align:center;">
                {{ $entregas->count() }} entrega{{ $entregas->count() != 1 ? 's' : '' }}
            </td>
            <td style="width:20px;"></td>
            <td style="padding: 8px 20px; background:#3b82f6; color:white; border-radius:8px; font-weight:bold; text-align:center;">
                 {{ $retiradas->count() }} retirada{{ $retiradas->count() != 1 ? 's' : '' }}
            </td>
        </tr>
    </table>

    {{-- ENTREGAS --}}
    <div class="secao-titulo titulo-entrega"> Entregas no Endereço</div>
    <table>
        <thead>
            <tr>
                <th class="th-entrega">Cliente</th>
                <th class="th-entrega">Retirador</th>
                <th class="th-entrega">Endereço</th>
                <th class="th-entrega">Horário</th>
                <th class="th-entrega">Produtos</th>
                <th class="th-entrega">Total</th>
                <th class="th-entrega">Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entregas as $pedido)
                <tr>
                    <td>{{ $pedido->cliente->nome }}</td>
                    <td>{{ $pedido->entrega->nome_retirador ?? '-' }}</td>
                    <td>{{ $pedido->entrega->endereco ?? '-' }}</td>
                    <td>{{ $pedido->entrega->hora_entrega ?? '-' }}</td>
                    <td>
                        @foreach($pedido->itens as $item)
                            {{ $item->produto->nome }} ({{ $item->quantidade }}kg)@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($pedido->forma_pagamento) }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="vazio">Nenhuma entrega para amanhã.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- RETIRADAS --}}
    <div class="secao-titulo titulo-retirada"> Retiradas no Local</div>
    <table>
        <thead>
            <tr>
                <th class="th-retirada">Cliente</th>
                <th class="th-retirada">Telefone</th>
                <th class="th-retirada">Produtos</th>
                <th class="th-retirada">Total</th>
                <th class="th-retirada">Pagamento</th>
                <th class="th-retirada">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($retiradas as $pedido)
                <tr>
                    <td>{{ $pedido->cliente->nome }}</td>
                    <td>{{ $pedido->cliente->telefone }}</td>
                    <td>
                        @foreach($pedido->itens as $item)
                            {{ $item->produto->nome }} ({{ $item->quantidade }}kg)@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($pedido->forma_pagamento) }}</td>
                    <td>{{ ucfirst($pedido->status) }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="vazio">Nenhuma retirada para amanhã.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i') }} — Maison Cerise &copy; {{ now()->year }}
    </div>

</body>
</html>