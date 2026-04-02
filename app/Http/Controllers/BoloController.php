<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolo;
use App\Models\Pedido;

class BoloController extends Controller
{

    // LISTA
    public function index(Request $request)
    {
        $query = Bolo::query();

        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nome', 'like', '%' . $request->buscar . '%');
        }

        $dados = $query->orderBy('id', 'desc')->get();

        return view('bolo.list', compact('dados'));
    }


    // CREATE
    public function create()
    {
        return view('bolo.form');
    }


    // EDIT
    public function edit($id)
    {
        $bolo = Bolo::findOrFail($id);
        return view('bolo.form', compact('bolo'));
    }


    public function store(Request $request)
{
    $data = $request->only([
        'nome',
        'sabor_massa',
        'recheio',
        'cobertura',
        'valor'
    ]);

    if ($request->hasFile('imagem')) {
        $data['imagem'] = $request->file('imagem')->store('bolos', 'public');
    } else {
        $data['imagem'] = 'sem_imagem.png';
    }

    Bolo::create($data);

    return redirect()->route('bolos.index')
        ->with('sucesso', 'Bolo cadastrado com sucesso!');
}

public function update(Request $request, $id)
{
    $bolo = Bolo::findOrFail($id);

    $data = $request->only([
        'nome',
        'sabor_massa',
        'recheio',
        'cobertura',
        'valor'
    ]);

    //  nova imagem → substitui
    if ($request->hasFile('imagem')) {
        $data['imagem'] = $request->file('imagem')->store('bolos', 'public');
    }

    $bolo->update($data);

    return redirect()->route('bolos.index')
        ->with('sucesso', 'Bolo atualizado com sucesso!');
}
    
    public function destroy($id)
    {
        $temPedido = Pedido::where('bolo_id', $id)->exists();

        if ($temPedido) {
            return redirect()
                ->route('bolos.index')
                ->with('erro', 'Não pode excluir. Este bolo está em pedidos.');
        }

        $bolo = Bolo::findOrFail($id);
        $bolo->delete();

        return redirect()
            ->route('bolos.index')
            ->with('sucesso', 'Bolo excluído com sucesso!');
    }

}