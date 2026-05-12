<?php
namespace App\Http\Controllers;

use App\Models\Entrega;

class EntregaController extends Controller
{
    public function index()
    {
        // traz pedido + cliente junto
        $entregas = Entrega::with('pedido.cliente')->get();

        return view('entregas.index', compact('entregas'));
    }
}
