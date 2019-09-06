<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LancamentosController extends Controller
{
    public function index()
    {
        $lancamentos    = Lancamento::where('usuario_id', Auth::user()->id)->get();
        $itens          = Item::all()->pluck('nome', 'id')->toArray();
        
        return view('lancamentos.index')
            ->with('lancamentos', $lancamentos)
            ->with('itens', $itens);
    }
    
    public function create()
    {
        return view('lancamentos.create');
    }
    
    public function store(Request $request)
    {
        $lancamento = Lancamento::create($request->all());
        $lancamento->itens()->attach($request->get('items'));
        $lancamento->save();
        
        return redirect()->route('lancamentos.listar');
    }
    
    public function edit($id)
    {
        $lancamento     = Lancamento::findOrFail($id);
        $itensSelected  = $lancamento->itens->map(function (Item $item) {
            return $item->id;
        })->toArray();
        $itens          = Item::all()->pluck('nome', 'id')->toArray();
        
        return view('lancamentos.edit')
            ->with('lancamento', $lancamento)
            ->with('itens', $itens)
            ->with('itensSelected', $itensSelected);
    }
    
    public function update(Request $request, $id)
    {
        $lancamento = Lancamento::findOrFail($id);
        $lancamento->itens()->sync($request->get('items'));
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
