<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\ItemPedido;
use App\Models\Entrega;

class PedidoController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $query = Pedido::with(['cliente', 'itens.produto'])
            ->orderBy('created_at', 'desc');

        if (request('buscar')) {
            $query->whereHas('cliente', function ($q) {
                $q->where('nome', 'like', '%' . request('buscar') . '%');
=======
        $query = Pedido::with([
                'cliente',
                'itens.produto',
                'entrega'
            ])
            ->orderBy('created_at', 'desc');

        if (request('buscar')) {

            $query->whereHas('cliente', function ($q) {

                $q->where(
                    'nome',
                    'like',
                    '%' . request('buscar') . '%'
                );

>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
            });
        }

        $pedidos = $query->get();

        return view('pedidos.list', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
<<<<<<< HEAD
        $produtos = Produto::all();

        return view('pedidos.form', compact('clientes', 'produtos'));
=======

        $produtos = Produto::all();

        return view('pedidos.form', compact(
            'clientes',
            'produtos'
        ));
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    }

    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'cliente_id'         => 'required|exists:clientes,id',
            'data_pedido'        => 'required|date',
            'data_entrega'       => 'nullable|date',
            'forma_pagamento'    => 'required|string',
            'itens'              => 'required|array',
            'itens.*.produto_id'    => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|numeric|min:0.01',
        ]);

        $pedido = Pedido::create([
            'cliente_id'      => $request->cliente_id,
            'data_pedido'     => $request->data_pedido,
            'data_entrega'    => $request->data_entrega,
            'forma_pagamento' => $request->forma_pagamento,
            'status'          => 'pendente',
            'tem_entrega'     => $request->has('tem_entrega'),
            'valor_total'     => 0
        ]);

        $total = 0;

        foreach ($request->itens as $item) {
            $produto     = Produto::findOrFail($item['produto_id']);
            $subtotal = $produto->valor * $item['quantidade'];

            ItemPedido::create([
                'pedido_id'      => $pedido->id,
                'produto_id'        => $item['produto_id'],
                'quantidade'     => $item['quantidade'],
                'valor_unitario' => $produto->valor,
                'observacoes'    => $item['observacoes'] ?? null,
            ]);

            $total += $subtotal;
        }

       $pedido->update(['valor_total' => $total]);

    // Cria entrega automaticamente se marcado
    if ($pedido->tem_entrega) {
        Entrega::create([
            'pedido_id' => $pedido->id,
            'status'    => 'pendente',
        ]);

        // Adiciona R$15 de taxa de entrega
        $pedido->update(['valor_total' => $total + 15]);
    }

        return redirect()->route('pedidos.index')
            ->with('sucesso', 'Pedido criado com sucesso!');
    }

    public function edit($id)
    {
        $pedido   = Pedido::with('itens')->findOrFail($id);
        $clientes = Cliente::all();
        $produtos    = Produto::all();

        return view('pedidos.form', compact('pedido', 'clientes', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id'         => 'required|exists:clientes,id',
            'data_pedido'        => 'required|date',
            'data_entrega'       => 'nullable|date',
            'forma_pagamento'    => 'required|string',
            'itens'              => 'required|array',
            'itens.*.produto_id'    => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|numeric|min:0.01',
        ]);

        $pedido = Pedido::findOrFail($id);

        $temEntrega = $request->has('tem_entrega');

        $pedido->update([
            'cliente_id'      => $request->cliente_id,
            'data_pedido'     => $request->data_pedido,
            'data_entrega'    => $request->data_entrega,
            'forma_pagamento' => $request->forma_pagamento,
            'tem_entrega'     => $temEntrega,
        ]);

        $pedido->itens()->delete();

        $total = 0;

        foreach ($request->itens as $item) {
            $produto     = Produto::findOrFail($item['produto_id']);
            $subtotal = $produto->valor * $item['quantidade'];

            ItemPedido::create([
                'pedido_id'      => $pedido->id,
                'produto_id'        => $item['produto_id'],
                'quantidade'     => $item['quantidade'],
                'valor_unitario' => $produto->valor,
                'observacoes'    => $item['observacoes'] ?? null,
            ]);

            $total += $subtotal;
        }

        $pedido->update(['valor_total' => $total]);

        // Se marcou tem_entrega e não existe entrega ainda, cria
        $pedido->update(['valor_total' => $total]);

// Cria entrega automaticamente se marcado
    if ($pedido->tem_entrega) {
        Entrega::create([
            'pedido_id' => $pedido->id,
            'status'    => 'pendente',
        ]);

        // Adiciona R$15 de taxa de entrega
        $pedido->update(['valor_total' => $total + 15]);
}

        return redirect()->route('pedidos.index')
            ->with('sucesso', 'Pedido atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->itens()->delete();
        if ($pedido->entrega) {
            $pedido->entrega->delete();
        }
        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('sucesso', 'Pedido excluído com sucesso!');
    }

    public function entregar($id)
=======

            'cliente_id'            => 'required|exists:clientes,id',
            'data_pedido'           => 'required|date',
            'data_entrega'          => 'nullable|date',
            'forma_pagamento'       => 'required|string',

            'itens'                 => 'required|array',

            'itens.*.produto_id'    => 'required|exists:produtos,id',

            'itens.*.quantidade'    => 'required|numeric|min:0.01',

        ]);

        $temEntrega = $request->has('tem_entrega');

        $pedido = Pedido::create([

            'cliente_id'      => $request->cliente_id,

            'data_pedido'     => $request->data_pedido,

            'data_entrega'    => $request->data_entrega,

            'forma_pagamento' => $request->forma_pagamento,

            'status'          => 'pendente',

            'tem_entrega'     => $temEntrega,

            'valor_total'     => 0

        ]);

        $total = 0;

        foreach ($request->itens as $item) {

            $produto = Produto::findOrFail(
                $item['produto_id']
            );

            $subtotal =
                $produto->valor *
                $item['quantidade'];

            ItemPedido::create([

                'pedido_id'      => $pedido->id,

                'produto_id'     => $item['produto_id'],

                'quantidade'     => $item['quantidade'],

                'valor_unitario' => $produto->valor,

                'observacoes'    => $item['observacoes'] ?? null,

            ]);

            $total += $subtotal;
        }

        $valorFinal = $total;

        // ENTREGA
        if ($temEntrega) {

            $valorFinal += 15;

            Entrega::create([

                'pedido_id' => $pedido->id,

                'status'    => $pedido->status,

            ]);
        }

        $pedido->update([
            'valor_total' => $valorFinal
        ]);

        return redirect()
            ->route('pedidos.index')
            ->with(
                'sucesso',
                'Pedido criado com sucesso!'
            );
    }

    public function edit($id)
    {
        $pedido = Pedido::with([
                'itens',
                'entrega'
            ])
            ->findOrFail($id);

        $clientes = Cliente::all();

        $produtos = Produto::all();

        return view('pedidos.form', compact(
            'pedido',
            'clientes',
            'produtos'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'cliente_id'            => 'required|exists:clientes,id',

            'data_pedido'           => 'required|date',

            'data_entrega'          => 'nullable|date',

            'forma_pagamento'       => 'required|string',

            'itens'                 => 'required|array',

            'itens.*.produto_id'    => 'required|exists:produtos,id',

            'itens.*.quantidade'    => 'required|numeric|min:0.01',

        ]);

        $pedido = Pedido::with('entrega')
            ->findOrFail($id);

        $temEntrega = $request->has('tem_entrega');

        $pedido->update([

            'cliente_id'      => $request->cliente_id,

            'data_pedido'     => $request->data_pedido,

            'data_entrega'    => $request->data_entrega,

            'forma_pagamento' => $request->forma_pagamento,

            'tem_entrega'     => $temEntrega,

        ]);

        // REMOVE ITENS ANTIGOS
        $pedido->itens()->delete();

        $total = 0;

        foreach ($request->itens as $item) {

            $produto = Produto::findOrFail(
                $item['produto_id']
            );

            $subtotal =
                $produto->valor *
                $item['quantidade'];

            ItemPedido::create([

                'pedido_id'      => $pedido->id,

                'produto_id'     => $item['produto_id'],

                'quantidade'     => $item['quantidade'],

                'valor_unitario' => $produto->valor,

                'observacoes'    => $item['observacoes'] ?? null,

            ]);

            $total += $subtotal;
        }

        $valorFinal = $total;

        // ENTREGA
        if ($temEntrega) {

            $valorFinal += 15;

            // SE JÁ EXISTE ENTREGA
            if ($pedido->entrega) {

                $pedido->entrega->update([

                    'status' => $pedido->status,

                ]);

            } else {

                // SE NÃO EXISTE
                Entrega::create([

                    'pedido_id' => $pedido->id,

                    'status'    => $pedido->status,

                ]);
            }

        } else {

            // REMOVE ENTREGA
            if ($pedido->entrega) {

                $pedido->entrega->delete();

            }

        }

        $pedido->update([
            'valor_total' => $valorFinal
        ]);

        return redirect()
            ->route('pedidos.index')
            ->with(
                'sucesso',
                'Pedido atualizado com sucesso!'
            );
    }

    public function destroy($id)
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['status' => 'entregue']);

<<<<<<< HEAD
        return redirect()->back()
            ->with('sucesso', 'Pedido marcado como entregue!');
=======
        $pedido->itens()->delete();

        if ($pedido->entrega) {

            $pedido->entrega->delete();

        }

        $pedido->delete();

        return redirect()
            ->route('pedidos.index')
            ->with(
                'sucesso',
                'Pedido excluído com sucesso!'
            );
    }

    public function entregar($id)
    {
        $pedido = Pedido::with('entrega')
            ->findOrFail($id);

        $pedido->update([

            'status' => 'entregue'

        ]);

        // SINCRONIZA ENTREGA
        if ($pedido->entrega) {

            $pedido->entrega->update([

                'status' => 'entregue'

            ]);

        }

        return redirect()
            ->back()
            ->with(
                'sucesso',
                'Pedido marcado como entregue!'
            );
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    }
}