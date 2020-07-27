<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'items';

    protected $fillable = [
        'name',
        'code',
        'quantity',
        'value',
        'type',
    ];

    public function entries ()
    {
        return $this->belongsToMany(Entry::class, 'entries_items');
    }
}
