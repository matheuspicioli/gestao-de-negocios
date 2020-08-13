<?php

namespace App\Http\Controllers;

use App\Helpers\Money;
use App\Models\Item;
use Illuminate\Http\Request;

class ItensController extends Controller
{
    public function index()
    {
        $itens = Item::all();

        return view('itens.index')
            ->with('itens', $itens);
    }

    public function create()
    {
        return view('itens.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['value'] = Money::moneyToDatabase($data['value']);
        Item::create($data);
        return redirect()->route('itens.listar');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        return view('itens.edit')
            ->with('item', $item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('itens.listar');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('itens.listar');
    }

    public function get($id)
    {
        return Item::findOrFail($id);
    }
}
