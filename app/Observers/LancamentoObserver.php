<?php

namespace App\Observers;

use App\Models\Entry;
use App\Models\Report;

class LancamentoObserver
{
    /**
     * Handle the lancamento "created" event.
     *
     * @param Entry $entry
     * @return void
     */
    public function created(Entry $entry)
    {
        Report::create([
            'class'    => Entry::class,
            'class_id' => $entry->id,
            'event'    => 'created',
            'data'     => "Quantidade (cada): {$entry->quantity}, transação: {$entry->transaction}",
        ]);
    }

    /**
     * Handle the lancamento "updated" event.
     *
     * @param  \App\Models\Entry  $entry
     * @return void
     */
    public function updated(Entry $entry)
    {
        Report::create([
            'class'    => Entry::class,
            'class_id' => $entry->id,
            'event'    => 'updated',
            'data'     => "Quantidade (cada): {$entry->quantity}, transaction: {$entry->transaction}",
        ]);
    }

    /**
     * Handle the lancamento "deleted" event.
     *
     * @param  \App\Models\Entry  $entry
     * @return void
     */
    public function deleted(Entry $entry)
    {
        Report::create([
            'class'    => Entry::class,
            'class_id' => $entry->id,
            'event'    => 'deleted',
            'data'     => "Quantidade (cada): {$entry->quantity}, transaction: {$entry->transaction}",
        ]);
    }

    /**
     * Handle the lancamento "restored" event.
     *
     * @param  \App\Models\Entry  $lancamento
     * @return void
     */
    public function restored(Entry $lancamento)
    {
        //
    }

    /**
     * Handle the lancamento "force deleted" event.
     *
     * @param  \App\Models\Entry  $lancamento
     * @return void
     */
    public function forceDeleted(Entry $lancamento)
    {
        //
    }
}
