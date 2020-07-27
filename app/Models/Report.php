<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $table = 'reports';

    protected $fillable = [
        'class',
        'event',
        'data',
        'class_id',
    ];

    protected $casts = [
        'class_id' => 'integer',
        'data'     => 'array',
    ];

    public function scopeEvent ($query, string $evento)
    {
        return $query->where('event', $evento);
    }

}
