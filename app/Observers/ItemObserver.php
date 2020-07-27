<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Report;

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
        $price = 'R$ '.number_format($item->price, 2, ',', '.');
        Report::create([
            'class'    => Item::class,
            'class_id' => $item->id,
            'event'    => 'created',
            'data'     => "Nome: {$item->name}, preço: {$price}, tipo: {$item->type}",
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
        $price = 'R$ '.number_format($item->price, 2, ',', '.');
        Report::create([
            'class'    => Item::class,
            'class_id' => $item->id,
            'event'    => 'updated',
            'data'     => "Nome: {$item->name}, preço: {$price}, tipo: {$item->type}",
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
        $price = 'R$ '.number_format($item->price, 2, ',', '.');
        Report::create([
            'class'    => Item::class,
            'class_id' => $item->id,
            'event'    => 'deleted',
            'data'     => "Nome: {$item->name}, preço: {price}, tipo: {$item->type}",
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
