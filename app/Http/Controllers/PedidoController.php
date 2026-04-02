<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Bolo;

class PedidoController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $pedidos = Pedido::with(['cliente', 'bolo'])
            ->when($buscar, function ($query, $buscar) {
                $query->whereHas('cliente', function ($q) use ($buscar) {
                    $q->where('nome', 'like', "%$buscar%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos.list', compact('pedidos'));
    }


    public function create()
    {
        $clientes = Cliente::all();
        $bolos = Bolo::all();

        return view('pedidos.form', compact('clientes', 'bolos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'bolo_id' => 'required|exists:bolos,id',
            'quantidade' => 'required|numeric|min:0.1',
            'data_pedido' => 'required|date',
            'data_entrega' => 'nullable|date',
            'forma_pagamento' => 'required|string|max:50',
        ]);

        $bolo = Bolo::findOrFail($request->bolo_id);

        $valor_total = $bolo->valor * $request->quantidade;

        Pedido::create([
            'cliente_id' => $request->cliente_id,
            'bolo_id' => $request->bolo_id,
            'quantidade' => $request->quantidade,
            'valor_total' => $valor_total,
            'data_pedido' => $request->data_pedido,
            'data_entrega' => $request->data_entrega,
            'forma_pagamento' => $request->forma_pagamento,
            'status' => 'pendente',
        ]);

        return redirect()
    ->route('pedidos.index')
    ->with('sucesso', 'Pedido criado com sucesso!');
    }


    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();
        $bolos = Bolo::all();

        return view('pedidos.form', compact('pedido', 'clientes', 'bolos'));
    }


    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'cliente_id' => 'required',
            'bolo_id' => 'required',
            'quantidade' => 'required|numeric',
            'data_pedido' => 'required',
            'forma_pagamento' => 'required',
            'status' => 'required|string'
        ]);

        $bolo = Bolo::findOrFail($request->bolo_id);

        $valor_total = $bolo->valor * $request->quantidade;

        $pedido->update([
            'cliente_id' => $request->cliente_id,
            'bolo_id' => $request->bolo_id,
            'quantidade' => $request->quantidade,
            'valor_total' => $valor_total,
            'data_pedido' => $request->data_pedido,
            'data_entrega' => $request->data_entrega,
            'forma_pagamento' => $request->forma_pagamento,
            'status' => $request->status, 
        ]);

        return redirect()
    ->route('pedidos.index')
    ->with('sucesso', 'Pedido atualizado com sucesso!');
    }


    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

       return redirect()
    ->route('pedidos.index')
    ->with('sucesso', 'Pedido excluído com sucesso!');
    }


    public function entregar($id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->status = 'entregue';

        $pedido->save();

        return redirect()
    ->route('pedidos.index')
    ->with('sucesso', 'Pedido entregue com sucesso!');
    }
}