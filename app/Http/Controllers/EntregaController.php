<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrega;
use Carbon\Carbon;

class EntregaController extends Controller
{
    public function index()
    {
        $entregas = Entrega::with([
                'pedido.cliente',
                'pedido.itens.produto'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('entregas.index', compact('entregas'));
    }

    public function edit($id)
    {
        $entrega = Entrega::with([
                'pedido.cliente',
                'pedido.itens.produto'
            ])
            ->findOrFail($id);

        return view('entregas.form', compact('entrega'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_retirador' => 'nullable|string|max:255',
            'endereco'       => 'nullable|string|max:255',
            'hora_entrega'   => 'nullable|date_format:H:i',
            'status'         => 'required|string',
        ]);

        $entrega = Entrega::findOrFail($id);

        $entrega->update($request->all());

        return redirect()
            ->route('entregas.index')
            ->with('sucesso', 'Entrega atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Entrega::findOrFail($id)->delete();

        return redirect()
            ->route('entregas.index')
            ->with('sucesso', 'Entrega removida com sucesso!');
    }

    public function calendario($ano = null, $mes = null)
    {
        $ano = $ano ?? now()->year;
        $mes = $mes ?? now()->month;

        $inicio = Carbon::createFromDate($ano, $mes, 1)->startOfMonth();

        $fim = Carbon::createFromDate($ano, $mes, 1)->endOfMonth();

        $entregas = Entrega::with([
                'pedido.cliente',
                'pedido.itens.produto'
            ])
            ->whereHas('pedido', function ($query) use ($inicio, $fim) {

                $query->whereNotNull('data_entrega')
                      ->whereBetween('data_entrega', [$inicio, $fim]);

            })
            ->get()
            ->groupBy(function ($entrega) {

                return Carbon::parse(
                    $entrega->pedido->data_entrega
                )->format('Y-m-d');

            });

        $mesAnterior = Carbon::createFromDate($ano, $mes, 1)
            ->subMonth();

        $proximoMes = Carbon::createFromDate($ano, $mes, 1)
            ->addMonth();

        return view('entregas.calendario', compact(
            'entregas',
            'ano',
            'mes',
            'inicio',
            'fim',
            'mesAnterior',
            'proximoMes'
        ));
    }
}