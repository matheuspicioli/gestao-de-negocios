<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use SoftDeletes;

    protected $table = 'lancamentos';

    protected $fillable = [
        'tipo',
        'usuario_id',
    ];

    protected $appends = [
        'preco_total',
        'items_string',
    ];

    public function usuario ()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function itens ()
    {
        return $this->belongsToMany(Item::class, 'lancamentos_items')->withPivot('quantidade');
    }

    public function getItemsStringAttribute ()
    {
        $items = '';

        $this->itens->each(function (Item $item) use (&$items) {
            $items .= "<span class='label label-success' style='margin-left: 5px; margin-right: 5px;'>{$item->nome} x {$item->pivot->quantidade}</span>";
        });

        return $items;
    }

    public function getPrecoTotalAttribute ()
    {
        $total = 0;

        foreach ($this->itens as $item) {
            $total += $item->preco * $item->pivot->quantidade;
        }

        return $total;
    }
}
