<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Produto;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LancamentosController extends Controller
{
    public function index()
    {
        $lancamentos    = Lancamento::where('usuario_id', Auth::user()->id)->get();
        $produtos       = Produto::all()->pluck('nome', 'id')->prepend('Selecione...')->toArray();
        $servicos       = Servico::all()->pluck('nome', 'id')->prepend('Selecione...')->toArray();
        
        return view('lancamentos.index')
            ->with('lancamentos', $lancamentos)
            ->with('produtos', $produtos)
            ->with('servicos', $servicos);
    }
    
    public function create()
    {
        return view('lancamentos.create');
    }
    
    public function store(Request $request)
    {
        Lancamento::create($request->all());
        return redirect()->route('lancamentos.listar');
    }
    
    public function edit($id)
    {
        $lancamento = Lancamento::findOrFail($id);
        
        return view('lancamentos.edit')
            ->with('lancamento', $lancamento);
    }
    
    public function update(Request $request, $id)
    {
        $lancamento = Lancamento::findOrFail($id);
        $lancamento->update($request->all());
        
        return redirect()->route('lancamentos.listar');
    }
    
    public function destroy($id)
    {
        $lancamento = Lancamento::findOrFail($id);
        $lancamento->delete();
        
        return redirect()->route('lancamentos.listar');
    }
}
