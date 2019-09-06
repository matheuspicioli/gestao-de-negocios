<?php

namespace App\Http\Controllers;

use App\Models\Item;

class EstoquesController extends Controller
{
    public function index ()
    {
        $itens = Item::all();
        
        return view('estoque.index')
            ->with('itens', $itens);
    }
}
