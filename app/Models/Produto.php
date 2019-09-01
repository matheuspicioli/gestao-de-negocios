<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    
    protected $table = 'produtos';
    
    protected $fillable = [
        'nome',
        'preco',
    ];
    
    public function lancamentos ()
    {
        return $this->hasMany(Lancamento::class, 'produto_id', 'id');
    }
}
