<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $fillable = [
        'photo',
        'name',
        'cpf',
        'rg',
        'email',
        'genre_id',
        'observations',
        'active',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }
}
