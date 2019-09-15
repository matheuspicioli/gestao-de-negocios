<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lancamento;
use App\Models\Relatorio;
use PDF;

class RelatoriosController extends Controller
{
    public function index ()
    {
        $quantidade_itens = Relatorio::where('classe', Item::class)->get()->count();
        $quantidade_lancamentos = Relatorio::where('classe', Lancamento::class)->get()->count();
        
        return view('relatorios.index')
            ->with('quantidade_itens', $quantidade_itens)
            ->with('quantidade_lancamentos', $quantidade_lancamentos);
    }
    
    public function estoque ()
    {
        $relatorios_estoque = Relatorio::where('classe', Item::class)->get();
        
        return view('relatorios.estoque.index')
            ->with('relatorios_estoque', $relatorios_estoque);
    }
    
    public function gerarRelatorioEstoque ()
    {
        $data = Relatorio::where('classe', Item::class)->get();
        $pdf = PDF::loadView('relatorios.estoque.pdf', ['relatorios' => $data]);
        return $pdf->download('Relatório estoque.pdf');
    }
    
    public function lancamento ()
    {
        $relatorios_lancamento = Relatorio::where('classe', Lancamento::class)->get();
        
        return view('relatorios.lancamento.index')
            ->with('relatorios_lancamento', $relatorios_lancamento);
    }
    
    public function gerarRelatorioLancamento ()
    {
        $data = Relatorio::where('classe', Lancamento::class)->get();
        $pdf = PDF::loadView('relatorios.lancamento.pdf', ['relatorios' => $data]);
        return $pdf->download('Relatório lançamento.pdf');
    }
}
