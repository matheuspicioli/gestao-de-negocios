<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;

    protected $table = 'providers';
    protected $fillable = [
        'photo',
        'company_name',
        'fantasy_name',
        'cnpj',
        'email',
        'segment',
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
