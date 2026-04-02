<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pedido;

class ClienteController extends Controller
{
  
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->has('buscar') && $request->buscar != '') {
            $busca = $request->buscar;
            $query->where('nome', 'like', "%$busca%")
                  ->orWhere('email', 'like', "%$busca%")
                  ->orWhere('telefone', 'like', "%$busca%")
                  ->orWhere('cpf', 'like', "%$busca%")
                  ->orWhere('endereco', 'like', "%$busca%");
        }

        $dados = $query->orderBy('id', 'desc')->get();
        return view('cliente.list', compact('dados'));
    }

    
    public function create()
    {
        return view('cliente.form');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'required',
            'cpf' => 'required|unique:clientes,cpf',
            'endereco' => 'nullable',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
                         ->with('sucesso', 'Cliente criado com sucesso!');
    }


    public function edit($id)
    {
        $dado = Cliente::findOrFail($id);
        return view('cliente.form', compact('dado'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:clientes,email,' . $id,
            'telefone' => 'required',
            'cpf' => 'required|unique:clientes,cpf,' . $id,
            'endereco' => 'nullable',
        ]);

        Cliente::findOrFail($id)->update($request->all());

        return redirect()->route('clientes.index')
                         ->with('sucesso', 'Cliente atualizado com sucesso!');
    }

  
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente->pedidos()->count() > 0) {
            return redirect()->route('clientes.index')
                             ->with('erro', 'Não é possível excluir este cliente, pois ele possui pedidos!');
        }

        $cliente->delete();

        return redirect()->route('clientes.index')
                         ->with('sucesso', 'Cliente excluído com sucesso!');
    }

    // Pesquisa AJAX para Select2
    public function buscar(Request $request)
    {
        $termo = $request->input('q');

        $clientes = Cliente::where('nome', 'like', "%$termo%")
                            ->orderBy('nome')
                            ->take(10)
                            ->get();

        $resultado = $clientes->map(function ($c) {
            return ['id' => $c->id, 'text' => $c->nome];
        });

        return response()->json($resultado);
    }
}