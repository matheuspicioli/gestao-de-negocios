<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Relatorio;

class ItemObserver
{
    /**
     * Handle the item "created" event.
     *
     * @param \App\Models\Item $item
     *
     * @return void
     */
    public function created (Item $item)
    {
        $preco = 'R$ '.number_format($item->preco, 2, ',', '.');
        Relatorio::create([
            'classe'    => Item::class,
            'classe_id' => $item->id,
            'evento'    => 'created',
            'dados'     => "Nome: {$item->nome}, preço: {$preco}, tipo: {$item->tipo}",
        ]);
    }
    
    /**
     * Handle the item "updated" event.
     *
     * @param \App\Models\Item $item
     *
     * @return void
     */
    public function updated (Item $item)
    {
        $preco = 'R$ '.number_format($item->preco, 2, ',', '.');
        Relatorio::create([
            'classe'    => Item::class,
            'classe_id' => $item->id,
            'evento'    => 'updated',
            'dados'     => "Nome: {$item->nome}, preço: {$preco}, tipo: {$item->tipo}",
        ]);
    }
    
    /**
     * Handle the item "deleted" event.
     *
     * @param \App\Models\Item $item
     *
     * @return void
     */
    public function deleted (Item $item)
    {
        $preco = 'R$ '.number_format($item->preco, 2, ',', '.');
        Relatorio::create([
            'classe'    => Item::class,
            'classe_id' => $item->id,
            'evento'    => 'deleted',
            'dados'     => "Nome: {$item->nome}, preço: {$preco}, tipo: {$item->tipo}",
        ]);
    }
    
    /**
     * Handle the item "restored" event.
     *
     * @param \App\Models\Item $item
     *
     * @return void
     */
    public function restored (Item $item)
    {
        //
    }
    
    /**
     * Handle the item "force deleted" event.
     *
     * @param \App\Models\Item $item
     *
     * @return void
     */
    public function forceDeleted (Item $item)
    {
        //
    }
}
