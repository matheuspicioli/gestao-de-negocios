<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        
        return view('produtos.index')
            ->with('produtos', $produtos);
    }
    
    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        Produto::create($request->all());
        return redirect()->route('produtos.listar');
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        
        return view('produtos.edit')
            ->with('produto', $produto);
    }
    
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());
    
        return redirect()->route('produtos.listar');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        
        return redirect()->route('produtos.listar');
    }
}
