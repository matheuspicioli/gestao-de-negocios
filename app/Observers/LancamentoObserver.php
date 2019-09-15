<?php

namespace App\Observers;

use App\Models\Lancamento;
use App\Models\Relatorio;

class LancamentoObserver
{
    /**
     * Handle the lancamento "created" event.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return void
     */
    public function created(Lancamento $lancamento)
    {
        Relatorio::create([
            'classe'    => Lancamento::class,
            'classe_id' => $lancamento->id,
            'evento'    => 'created',
            'dados'     => "Quantidade (cada): {$lancamento->quantidade}, tipo: {$lancamento->tipo}",
        ]);
    }

    /**
     * Handle the lancamento "updated" event.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return void
     */
    public function updated(Lancamento $lancamento)
    {
        Relatorio::create([
            'classe'    => Lancamento::class,
            'classe_id' => $lancamento->id,
            'evento'    => 'updated',
            'dados'     => "Quantidade (cada): {$lancamento->quantidade}, tipo: {$lancamento->tipo}",
        ]);
    }

    /**
     * Handle the lancamento "deleted" event.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return void
     */
    public function deleted(Lancamento $lancamento)
    {
        Relatorio::create([
            'classe'    => Lancamento::class,
            'classe_id' => $lancamento->id,
            'evento'    => 'deleted',
            'dados'     => "Quantidade (cada): {$lancamento->quantidade}, tipo: {$lancamento->tipo}",
        ]);
    }

    /**
     * Handle the lancamento "restored" event.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return void
     */
    public function restored(Lancamento $lancamento)
    {
        //
    }

    /**
     * Handle the lancamento "force deleted" event.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return void
     */
    public function forceDeleted(Lancamento $lancamento)
    {
        //
    }
}
