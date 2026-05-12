@extends('main')

@section('titulo', 'Calendário de Entregas')

@section('conteudo')
@import './main/calendario.css';

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Calendário de Entregas</h2>

    <a href="{{ route('entregas.index') }}" class="btn btn-voltar">
        Voltar às Entregas
    </a>
</div>

{{-- NAVEGAÇÃO --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <a href="{{ route('entregas.calendario.mes', [$mesAnterior->year, $mesAnterior->month]) }}"
       class="btn btn-entregar">

        ← {{ ucfirst($mesAnterior->translatedFormat('F Y')) }}

    </a>

    <h4 style="
        color: var(--cor-primaria);
        font-family: 'Playfair Display', serif;
        font-style: italic;
    ">
        {{ ucfirst($inicio->translatedFormat('F Y')) }}
    </h4>

    <a href="{{ route('entregas.calendario.mes', [$proximoMes->year, $proximoMes->month]) }}"
       class="btn btn-entregar">

        {{ ucfirst($proximoMes->translatedFormat('F Y')) }} →

    </a>

</div>

{{-- CALENDÁRIO --}}
<div class="calendario-grid mb-4">

    @php
        $diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
    @endphp

    @foreach($diasSemana as $dia)
        <div class="calendario-header">
            {{ $dia }}
        </div>
    @endforeach

    {{-- Espaços vazios --}}
    @for($i = 0; $i < $inicio->dayOfWeek; $i++)
        <div class="calendario-dia vazio"></div>
    @endfor

    {{-- Dias --}}
    @for($dia = 1; $dia <= $fim->day; $dia++)

        @php

            $data = \Carbon\Carbon::createFromDate(
                $ano,
                $mes,
                $dia
            )->format('Y-m-d');

            $entregasDia = $entregas->get($data, collect());

            $hoje = now()->format('Y-m-d') === $data;

        @endphp

        <div class="
            calendario-dia
            {{ $entregasDia->count() > 0 ? 'tem-entrega' : '' }}
            {{ $hoje ? 'hoje' : '' }}
        "

        @if($entregasDia->count() > 0)
            onclick="abrirPopup('{{ $data }}')"
            style="cursor:pointer;"
        @endif
        >

            <span class="numero-dia">
                {{ $dia }}
            </span>

            @if($entregasDia->count() > 0)

                <span class="badge-entrega">
                    {{ $entregasDia->count() }}
                    entrega{{ $entregasDia->count() > 1 ? 's' : '' }}
                </span>

                @foreach($entregasDia as $entrega)

                    @if($entrega->hora_entrega)

                        <small class="horario-entrega">

                            🕒
                            {{ \Carbon\Carbon::parse($entrega->hora_entrega)->format('H:i') }}

                        </small>

                    @endif

                @endforeach

            @endif

        </div>

    @endfor

</div>

{{-- OVERLAY --}}
<div id="overlay"
     onclick="fecharPopup()"
     style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
        z-index:999;
     ">
</div>

{{-- POPUP --}}
<div id="popup"
     style="
        display:none;
        position:fixed;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        background:white;
        border:2px solid var(--cor-secundaria);
        border-radius:16px;
        width:90%;
        max-width:600px;
        max-height:80vh;
        overflow-y:auto;
        z-index:1000;
     ">

    <div style="
        background:var(--cor-primaria);
        color:white;
        padding:16px 20px;
        border-radius:12px 12px 0 0;
        display:flex;
        justify-content:space-between;
        align-items:center;
    ">

        <h5 id="popup-titulo"
            style="
                margin:0;
                font-family:'Playfair Display',serif;
                font-style:italic;
            ">
        </h5>

        <button onclick="fecharPopup()"
                style="
                    background:none;
                    border:none;
                    color:white;
                    font-size:1.5rem;
                    cursor:pointer;
                ">
            ×
        </button>

    </div>

    <div id="popup-body"
         style="
            padding:20px;
            background:#fff5f5;
         ">
    </div>

</div>

{{-- DADOS ESCONDIDOS --}}
<div id="dados-entregas" style="display:none;">

@foreach($entregas as $data => $entregasDia)

    <div data-date="{{ $data }}"
         data-titulo="🍰 Entregas do dia {{ \Carbon\Carbon::parse($data)->translatedFormat('d \d\e F') }}">

        @foreach($entregasDia as $entrega)

            <div class="p-3 mb-3 border rounded"
                 style="
                    border:2px solid var(--cor-secundaria);
                 ">

                <p>
                    <strong>👤 Cliente:</strong>
                    {{ $entrega->pedido->cliente->nome }}
                </p>

                @if($entrega->hora_entrega)

                    <p>
                        <strong>🕒 Horário:</strong>

                        {{ \Carbon\Carbon::parse($entrega->hora_entrega)->format('H:i') }}
                    </p>

                @endif

                <p>
                    <strong>🎂 Produtos:</strong>

                    @foreach($entrega->pedido->itens as $item)

                        {{ $item->produto->nome }}
                        ({{ $item->quantidade }}kg)

                        @if(!$loop->last), @endif

                    @endforeach

                </p>

                <p>
                    <strong>💰 Total:</strong>

                    R$
                    {{ number_format($entrega->pedido->valor_total, 2, ',', '.') }}
                </p>

                <p>
                    <strong>💳 Pagamento:</strong>

                    {{ ucfirst($entrega->pedido->forma_pagamento) }}
                </p>

                <p>
                    <strong>📍 Endereço:</strong>

                    {{ $entrega->endereco ?? 'Não informado' }}
                </p>

                <span class="status-{{ $entrega->status }}">
                    {{ ucfirst($entrega->status) }}
                </span>

            </div>

        @endforeach

    </div>

@endforeach

</div>

<script>

function abrirPopup(data){

    const container = document.querySelector(
        `#dados-entregas [data-date="${data}"]`
    );

    if(!container) return;

    document.getElementById('popup-titulo').textContent =
        container.dataset.titulo;

    document.getElementById('popup-body').innerHTML =
        container.innerHTML;

    document.getElementById('overlay').style.display = 'block';

    document.getElementById('popup').style.display = 'block';
}

function fecharPopup(){

    document.getElementById('overlay').style.display = 'none';

    document.getElementById('popup').style.display = 'none';
}

</script>

@endsection