<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;

class ServicosController extends Controller
{
    public function index()
    {
        $servicos = Servico::all();
        
        return view('servicos.index')
            ->with('servicos', $servicos);
    }
    
    public function create()
    {
        return view('servicos.create');
    }
    
    public function store(Request $request)
    {
        Servico::create($request->all());
        return redirect()->route('servicos.listar');
    }
    
    public function edit($id)
    {
        $servico = Servico::findOrFail($id);
        
        return view('servicos.edit')
            ->with('servico', $servico);
    }
    
    public function update(Request $request, $id)
    {
        $produto = Servico::findOrFail($id);
        $produto->update($request->all());
        
        return redirect()->route('servicos.listar');
    }
    
    public function destroy($id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();
        
        return redirect()->route('servicos.listar');
    }
}
