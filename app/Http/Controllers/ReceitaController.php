<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;

class ReceitaController extends Controller
{

    public function index(Request $request)
    {
        $query = Receita::query(); 
        
        if ($request->has('buscar') && $request->buscar != '') {

            $busca = $request->buscar;

            $query->where('nome', 'like', "%$busca%");
        }

        $dados = $query->orderBy('id', 'desc')->get(); 

        return view('receita.list', compact('dados'));
    }


    function create()
    {
        return view('receita.form');
    }


    function store(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'ingredientes'=>'required',
            'modo_preparo'=>'required',
            'tempo_preparo'=>'required',
            'rendimento'=>'required'
        ]);

        Receita::create($request->all());

        return redirect()
            ->route('receitas.index')
            ->with('sucesso', 'Receita cadastrada com sucesso!');
    }


    function edit($id)
    {
        $dado = Receita::find($id);

        return view('receita.form', ['dado'=>$dado]);
    }


    function update(Request $request,$id)
    {
        Receita::find($id)->update($request->all());

        return redirect()
            ->route('receitas.index')
            ->with('sucesso', 'Receita atualizada com sucesso!');
    }


    function destroy($id)
    {
        Receita::destroy($id);

        return redirect()
            ->route('receitas.index')
            ->with('sucesso', 'Receita excluída com sucesso!');
    }

}