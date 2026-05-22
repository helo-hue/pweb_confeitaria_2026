<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Pedido;

class ProdutoController extends Controller
{

    // LISTA
    public function index(Request $request)
    {
        $query = Produto::query();

        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nome', 'like', '%' . $request->buscar . '%');
        }

        $dados = $query->orderBy('id', 'desc')->get();

        return view('produto.list', compact('dados'));
    }


    // CREATE
    public function create()
    {
        return view('produto.form');
    }


    // EDIT
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.form', compact('produto'));
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
        $data['imagem'] = $request->file('imagem')->store('produtos', 'public');
    } else {
        $data['imagem'] = 'sem_imagem.png';
    }

    Produto::create($data);

    return redirect()->route('produtos.index')
        ->with('sucesso', 'Produto cadastrado com sucesso!');
}

public function update(Request $request, $id)
{
    $produto = Produto::findOrFail($id);

    $data = $request->only([
        'nome',
        'sabor_massa',
        'recheio',
        'cobertura',
        'valor'
    ]);

    //  nova imagem → substitui
    if ($request->hasFile('imagem')) {
        $data['imagem'] = $request->file('imagem')->store('produtos', 'public');
    }

    $produto->update($data);

    return redirect()->route('produtos.index')
        ->with('sucesso', 'Produto atualizado com sucesso!');
}
    
public function destroy($id)
{
    $temPedido = \App\Models\ItemPedido::where('produto_id', $id)->exists();

    if ($temPedido) {
        return redirect()
            ->route('produtos.index')
            ->with('erro', 'Não pode excluir. Este produto está em pedidos.');
    }

    $produto = Produto::findOrFail($id);
    $produto->delete();

    return redirect()
        ->route('produtos.index')
        ->with('sucesso', 'Produto excluído com sucesso!');
}
}