<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Entry;
use App\Models\Report;
use PDF;

class RelatoriosController extends Controller
{
    public function index ()
    {
        $quantidade_itens = Report::where('classe', Item::class)->get()->count();
        $quantidade_lancamentos = Report::where('classe', Entry::class)->get()->count();

        return view('relatorios.index')
            ->with('quantidade_itens', $quantidade_itens)
            ->with('quantidade_lancamentos', $quantidade_lancamentos);
    }

    public function estoque ()
    {
        $relatorios_estoque = Report::where('classe', Item::class)->get();

        return view('relatorios.estoque.index')
            ->with('relatorios_estoque', $relatorios_estoque);
    }

    public function gerarRelatorioEstoque ()
    {
        $data = Report::where('classe', Item::class)->get();
        $pdf = PDF::loadView('relatorios.estoque.pdf', ['relatorios' => $data]);
        return $pdf->download('Relatório estoque.pdf');
    }

    public function lancamento ()
    {
        $relatorios_lancamento = Report::where('classe', Entry::class)->get();

        return view('relatorios.lancamento.index')
            ->with('relatorios_lancamento', $relatorios_lancamento);
    }

    public function gerarRelatorioLancamento ()
    {
        $data = Report::where('classe', Entry::class)->get();
        $pdf = PDF::loadView('relatorios.lancamento.pdf', ['relatorios' => $data]);
        return $pdf->download('Relatório lançamento.pdf');
    }
}
