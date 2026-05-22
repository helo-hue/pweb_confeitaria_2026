@extends('main')

@section('titulo', 'Calendário de Entregas')

@section('conteudo')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Calendário de Entregas</h2>
    <a href="{{ route('entregas.index') }}" class="btn btn-voltar">Voltar às Entregas</a>
</div>

{{-- NAVEGAÇÃO MÊS --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('entregas.calendario.mes', [$mesAnterior->year, $mesAnterior->month]) }}"
       class="btn btn-entregar">← {{ ucfirst($mesAnterior->translatedFormat('F Y')) }}</a>

    <h4 style="color: var(--cor-primaria); font-family: 'Playfair Display', serif; font-style: italic;">
        {{ ucfirst($inicio->translatedFormat('F Y')) }}
    </h4>

    <a href="{{ route('entregas.calendario.mes', [$proximoMes->year, $proximoMes->month]) }}"
       class="btn btn-entregar">{{ ucfirst($proximoMes->translatedFormat('F Y')) }} →</a>
</div>

{{-- LEGENDA --}}
<div class="d-flex gap-3 mb-4">
    <span class="badge-legenda badge-retirada">🏪 Retirada no local</span>
    <span class="badge-legenda badge-entrega-tipo">🚗 Entrega no endereço</span>
</div>

{{-- CALENDÁRIO --}}
<div class="calendario-grid mb-4">
    @php
        $diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
    @endphp

    @foreach($diasSemana as $dia)
        <div class="calendario-header">{{ $dia }}</div>
    @endforeach

    @for($i = 0; $i < $inicio->dayOfWeek; $i++)
        <div class="calendario-dia vazio"></div>
    @endfor

    @for($dia = 1; $dia <= $fim->day; $dia++)
        @php
            $data = \Carbon\Carbon::createFromDate($ano, $mes, $dia)->format('Y-m-d');
            $pedidosDia = $pedidos->get($data, collect());
            $hoje = now()->format('Y-m-d') === $data;

            $totalRetiradas = $pedidosDia->where('tem_entrega', false)->count();
            $totalEntregas  = $pedidosDia->where('tem_entrega', true)->count();
        @endphp

        <div class="calendario-dia
                {{ $pedidosDia->count() > 0 ? 'tem-pedido' : '' }}
                {{ $hoje ? 'hoje' : '' }}"
             @if($pedidosDia->count() > 0) onclick="abrirPopup('{{ $data }}')" style="cursor:pointer;" @endif>

            <span class="numero-dia">{{ $dia }}</span>

            @if($totalRetiradas > 0)
                <span class="badge-dia badge-dia-retirada">🏪 {{ $totalRetiradas }}</span>
            @endif

            @if($totalEntregas > 0)
                <span class="badge-dia badge-dia-entrega">🚗 {{ $totalEntregas }}</span>
            @endif
        </div>
    @endfor
</div>

{{-- OVERLAY E POPUP --}}
<div id="overlay" onclick="fecharPopup()" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;"></div>

<div id="popup" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:white; border:2px solid var(--cor-secundaria); border-radius:16px; width:90%; max-width:600px; max-height:80vh; overflow-y:auto; z-index:1000; padding:0;">
    <div id="popup-header" style="background:var(--cor-primaria); color:white; padding:16px 20px; border-radius:12px 12px 0 0; display:flex; justify-content:space-between; align-items:center;">
        <h5 id="popup-titulo" style="margin:0; font-family:'Playfair Display',serif; font-style:italic;"></h5>
        <button onclick="fecharPopup()" style="background:none; border:none; color:white; font-size:1.5rem; cursor:pointer; line-height:1;">×</button>
    </div>
    <div id="popup-body" style="padding:20px; background:#fff5f5;"></div>
    <div style="padding:12px 20px; background:#fff5f5; border-top:1px solid #f4d0d0; text-align:right; border-radius:0 0 12px 12px;">
        <button onclick="fecharPopup()" class="btn btn-voltar">Fechar</button>
    </div>
</div>

{{-- DADOS JSON OCULTOS --}}
<div id="dados-entregas" style="display:none;">
    @foreach($pedidos as $data => $pedidosDia)
        <div data-date="{{ $data }}"
             data-titulo="🍰 Entregas do dia {{ \Carbon\Carbon::parse($data)->translatedFormat('d \d\e F') }}">

            {{-- RETIRADAS --}}
            @php $retiradas = $pedidosDia->where('tem_entrega', false); @endphp
            @if($retiradas->count() > 0)
                <h6 class="popup-secao popup-secao-retirada">🏪 Retirada no Local</h6>
                @foreach($retiradas as $pedido)
                    <div class="popup-card popup-card-retirada">
                        <p><strong>👤 Cliente:</strong> {{ $pedido->cliente->nome }}</p>
                        <p><strong>🎂 Produtos:</strong>
                            @foreach($pedido->itens as $item)
                                {{ $item->produto->nome }} ({{ $item->quantidade }}kg)@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        <p><strong>💰 Total:</strong> R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</p>
                        <p><strong>💳 Pagamento:</strong> {{ ucfirst($pedido->forma_pagamento) }}</p>
                        <span class="status-{{ $pedido->status }}">{{ ucfirst($pedido->status) }}</span>
                    </div>
                @endforeach
            @endif

            {{-- ENTREGAS --}}
            @php $entregas = $pedidosDia->where('tem_entrega', true); @endphp
            @if($entregas->count() > 0)
                <h6 class="popup-secao popup-secao-entrega">🚗 Entrega no Endereço</h6>
                @foreach($entregas as $pedido)
                    <div class="popup-card popup-card-entrega">
                        <p><strong>👤 Cliente:</strong> {{ $pedido->cliente->nome }}</p>
                        @if($pedido->entrega)
                            @if($pedido->entrega->nome_retirador)
                                <p><strong>🙋 Retirador:</strong> {{ $pedido->entrega->nome_retirador }}</p>
                            @endif
                            @if($pedido->entrega->endereco)
                                <p><strong>📍 Endereço:</strong> {{ $pedido->entrega->endereco }}</p>
                            @endif
                            @if($pedido->entrega->hora_entrega)
                                <p><strong>🕐 Horário:</strong> {{ $pedido->entrega->hora_entrega }}</p>
                            @endif
                        @endif
                        <p><strong>🎂 Produtos:</strong>
                            @foreach($pedido->itens as $item)
                                {{ $item->produto->nome }} ({{ $item->quantidade }}kg)@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        <p><strong>💰 Total:</strong> R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</p>
                        <p><strong>💳 Pagamento:</strong> {{ ucfirst($pedido->forma_pagamento) }}</p>
                        <span class="status-{{ $pedido->status }}">{{ ucfirst($pedido->status) }}</span>
                    </div>
                @endforeach
            @endif

        </div>
    @endforeach
</div>

<style>
/* GRID */
.calendario-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 6px;
}

.calendario-header {
    background: var(--cor-primaria);
    color: white;
    text-align: center;
    padding: 10px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.85rem;
}

.calendario-dia {
    background: white;
    border: 2px solid var(--cor-secundaria);
    border-radius: 10px;
    min-height: 80px;
    padding: 8px;
    transition: all 0.2s;
}

.calendario-dia.vazio {
    background: transparent;
    border: none;
}

.calendario-dia.hoje {
    border-color: var(--cor-primaria);
    box-shadow: 0 0 0 2px var(--cor-primaria);
}

.calendario-dia.tem-pedido:hover {
    transform: translateY(-2px);
    box-shadow: 4px 4px 0px var(--cor-secundaria);
}

.numero-dia {
    font-weight: 700;
    color: var(--cor-primaria);
    font-size: 1rem;
    display: block;
}

/* BADGES DO DIA */
.badge-dia {
    display: block;
    margin-top: 4px;
    border-radius: 12px;
    padding: 2px 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-align: center;
    color: white;
}

.badge-dia-retirada { background: #3b82f6; } /* azul */
.badge-dia-entrega  { background: #ef4444; } /* vermelho */

/* LEGENDA */
.badge-legenda {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.82rem;
    font-weight: 700;
    color: white;
}

.badge-retirada    { background: #3b82f6; }
.badge-entrega-tipo { background: #ef4444; }

/* POPUP SEÇÕES */
.popup-secao {
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
    margin: 12px 0 8px;
    font-weight: 700;
}

.popup-secao-retirada { background: #3b82f6; }
.popup-secao-entrega  { background: #ef4444; }

/* POPUP CARDS */
.popup-card {
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 10px;
    border: 2px solid;
}

.popup-card-retirada {
    border-color: #3b82f6;
    background: #eff6ff;
}

.popup-card-entrega {
    border-color: #ef4444;
    background: #fff5f5;
}

.popup-card p { margin-bottom: 4px; }
</style>

<script>
function abrirPopup(data) {
    const container = document.querySelector(`#dados-entregas [data-date="${data}"]`);
    if (!container) return;

    document.getElementById('popup-titulo').textContent = container.dataset.titulo;
    document.getElementById('popup-body').innerHTML = container.innerHTML;
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

function fecharPopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}
</script>

@endsection