<?php

namespace App\Models;

use App\Enums\PaymentType;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;

    protected $table = 'entries';

    protected $fillable = [
        'transaction',
        'user_id',
        'payment_id',
    ];

    protected $appends = [
        'total_price',
        'items_string',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function itens ()
    {
        return $this->belongsToMany(Item::class, 'entries_items')->withPivot('quantity');
    }

    public function getPaymentAttribute()
    {
        return PaymentType::fromValue($this->payment_id)->key;
    }

    public function getItemsStringAttribute ()
    {
        $items = '';

        $this->itens->each(function (Item $item) use (&$items) {
            $items .= "<span class='label label-success' style='margin-left: 5px; margin-right: 5px;'>{$item->name} x {$item->pivot->quantity}</span>";
        });

        return $items;
    }

    public function getTotalPriceAttribute ()
    {
        $total = 0;

        foreach ($this->itens as $item) {
            $total += $item->value * $item->pivot->quantity;
        }

        return $total;
    }
}
