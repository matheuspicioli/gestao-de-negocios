<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'validity',
        'provider',
        'invoice',
    ];

    public function entries(): BelongsToMany
    {
        return $this->belongsToMany(Entry::class, 'entries_items');
    }
}
