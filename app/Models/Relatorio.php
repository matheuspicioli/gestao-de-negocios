<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relatorio extends Model
{
    use SoftDeletes;
    
    protected $table = 'relatorios';
    
    protected $fillable = [
        'classe',
        'evento',
        'dados',
        'classe_id',
    ];
    
    protected $casts = [
        'classe_id' => 'integer',
        'dados'     => 'array',
    ];
    
    public function scopeEvent ($query, string $evento)
    {
        return $query->where('evento', $evento);
    }
    
}
