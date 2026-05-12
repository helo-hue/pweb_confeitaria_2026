<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;

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
    public function pdfClientes()
{
    $clientesComPedidos = Cliente::with(['pedidos'])
        ->has('pedidos')
        ->orderBy('nome')
        ->get();

    $clientesSemPedidos = Cliente::doesntHave('pedidos')
        ->orderBy('nome')
        ->get();

    $pdf = Pdf::loadView('relatorios.pdf_clientes', compact('clientesComPedidos', 'clientesSemPedidos'));

    return $pdf->download('relatorio-clientes.pdf');
}
}