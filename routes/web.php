<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\BoloController;
use App\Http\Controllers\PedidoController;


use App\Models\Pedido;

Route::get('/', function () {

    $pedidos = Pedido::with(['cliente','bolo'])
        ->orderBy('id','desc')
        ->limit(10)
        ->get();

    return view('welcome', compact('pedidos'));

});


Route::resource('pedidos', PedidoController::class);

Route::put(
    '/pedidos/{id}/entregar',
    [PedidoController::class, 'entregar']
)->name('pedidos.entregar');


Route::resource('bolos', BoloController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('receitas', ReceitaController::class);
Route::get('/clientes/buscar', [ClienteController::class, 'buscar'])->name('clientes.buscar');