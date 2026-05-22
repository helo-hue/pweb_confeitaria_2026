<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\RelatorioController;
use App\Models\Pedido;
use App\Models\Produto; 

Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
Route::get('/relatorios/graficos', [RelatorioController::class, 'graficos'])->name('relatorios.graficos');
Route::get('/relatorios/pdf', [RelatorioController::class, 'pdf'])->name('relatorios.pdf');

Route::get('/', function () {
    $pedidos = Pedido::with(['cliente', 'itens.produto'])
        ->orderBy('id','desc')
        ->limit(10)
        ->get();
    return view('welcome', compact('pedidos'));
});

Route::resource('pedidos', PedidoController::class);
Route::put('/pedidos/{id}/entregar', [PedidoController::class, 'entregar'])->name('pedidos.entregar');

Route::resource('produtos', ProdutoController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('receitas', ReceitaController::class);
Route::get('/clientes/buscar', [ClienteController::class, 'buscar'])->name('clientes.buscar');

// ENTREGAS — calendario ANTES do {id}
Route::get('/entregas', [EntregaController::class, 'index'])->name('entregas.index');
Route::get('/entregas/calendario', [EntregaController::class, 'calendario'])->name('entregas.calendario');
Route::get('/entregas/calendario/{ano}/{mes}', [EntregaController::class, 'calendario'])->name('entregas.calendario.mes');
Route::get('/entregas/{id}/edit', [EntregaController::class, 'edit'])->name('entregas.edit');
Route::put('/entregas/{id}', [EntregaController::class, 'update'])->name('entregas.update');
Route::delete('/entregas/{id}', [EntregaController::class, 'destroy'])->name('entregas.destroy');
Route::get('/relatorios/clientes', [RelatorioController::class, 'clientesPdf'])->name('relatorios.clientes');
Route::get('/', function () {
    $pedidos = Pedido::with(['cliente', 'itens.produto'])
        ->orderBy('id','desc')
        ->limit(10)
        ->get();
    return view('welcome', compact('pedidos'));
})->name('welcome'); // <- só adicionar isso
Route::get('/relatorios/entregas-amanha', [RelatorioController::class, 'entregasAmanha'])->name('relatorios.entregas-amanha');
Route::get('/relatorios/entregas-dia', [RelatorioController::class, 'entregasDia'])->name('relatorios.entregas-dia');
Route::get('/relatorios/entregas-dia/pdf', [RelatorioController::class, 'entregasDiaPdf'])->name('relatorios.entregas-dia.pdf');