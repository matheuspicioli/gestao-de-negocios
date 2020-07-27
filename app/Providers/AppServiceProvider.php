<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\Entry;
use App\Observers\ItemObserver;
use App\Observers\LancamentoObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Item::observe(ItemObserver::class);
        Entry::observe(LancamentoObserver::class);
    }
}
