<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use SoftDeletes;

    protected $table = 'phones';
    protected $fillable = [
        'number',
        'type_id',
        'observations',
    ];
}
