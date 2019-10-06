<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    protected $table = 'items';
    
    protected $fillable = [
        'nome',
        'codigo',
        'quantidade',
        'preco',
        'tipo',
    ];
    
    public function lancamentos ()
    {
        return $this->belongsToMany(Item::class, 'lancamentos_items');
    }
}
