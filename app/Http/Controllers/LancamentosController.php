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
        $itens          = Item::where('quantidade', '>=', 1)->get()->pluck('nome', 'id')->toArray();
        
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
        $itens  = collect($request->get('itens'));
        $lancamento = Lancamento::create([
            'tipo'          => $request->get('tipo'),
            'usuario_id'    => $request->get('usuario_id'),
        ]);
        $itens->each(function ($item) {
            $itemEloquent = Item::findOrFail($item['id']);
            $itemEloquent->quantidade -= $item['quantidade'];
            $itemEloquent->save();
        });
    
        $lancamento->itens()->attach($itens->map(function ($item) {
            return $item['id'];
        }));
        
        return response()->json([
            'all' => $request->all()
        ]);
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
