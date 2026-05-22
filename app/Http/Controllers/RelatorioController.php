<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;
use Illuminate\Http\Request;
class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.painel');
    }

    public function graficos()
    {
        $comEntrega = Pedido::where('tem_entrega', true)->count();
        $semEntrega = Pedido::where('tem_entrega', false)->count();

        $produtos = ItemPedido::with('produto')
            ->selectRaw('produto_id, SUM(quantidade) as total_quantidade')
            ->groupBy('produto_id')
            ->orderBy('total_quantidade', 'desc')
            ->get();

        return view('relatorios.graficos', compact('comEntrega', 'semEntrega', 'produtos'));
    }

    public function pdf()
    {
        $pedidos = Pedido::with(['cliente', 'itens.produto'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('relatorios.pdf', compact('pedidos'));

        return $pdf->download('relatorio-pedidos.pdf');
    }

public function clientesPdf()
{
    $clientesAtivos = Cliente::whereHas('pedidos')
        ->withCount('pedidos')
        ->orderBy('nome')
        ->get();

    $clientesInativos = Cliente::whereDoesntHave('pedidos')
        ->orderBy('nome')
        ->get();

    $pdf = Pdf::loadView('relatorios.clientes', compact('clientesAtivos', 'clientesInativos'));

    return $pdf->download('relatorio-clientes.pdf');
}
public function entregasAmanha()
{
    $amanha = now()->addDay()->format('Y-m-d');

    $entregas = Pedido::with(['cliente', 'itens.produto', 'entrega'])
        ->whereDate('data_entrega', $amanha)
        ->where('tem_entrega', true)
        ->orderBy('created_at')
        ->get();

    $retiradas = Pedido::with(['cliente', 'itens.produto'])
        ->whereDate('data_entrega', $amanha)
        ->where('tem_entrega', false)
        ->orderBy('created_at')
        ->get();

    $pdf = Pdf::loadView('relatorios.entregas-amanha', compact('entregas', 'retiradas', 'amanha'));

    return $pdf->download('entregas-' . $amanha . '.pdf');
}public function entregasDia()
{
    return view('relatorios.entregas-dia');
}

public function entregasDiaPdf(Request $request)
{
    $request->validate([
        'data' => 'required|date',
    ]);

    $data = $request->data;

    $entregas = Pedido::with(['cliente', 'itens.produto', 'entrega'])
        ->whereDate('data_entrega', $data)
        ->where('tem_entrega', true)
        ->orderBy('created_at')
        ->get();

    $retiradas = Pedido::with(['cliente', 'itens.produto'])
        ->whereDate('data_entrega', $data)
        ->where('tem_entrega', false)
        ->orderBy('created_at')
        ->get();

    $pdf = Pdf::loadView('relatorios.entregas-amanha', compact('entregas', 'retiradas', 'data'));

    return $pdf->download('entregas-' . $data . '.pdf');
}
}