<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servico extends Model
{
    use SoftDeletes;
    
    protected $table = 'servicos';
    
    protected $fillable = [
        'nome',
        'preco',
    ];
    
    public function lancamentos ()
    {
        return $this->hasMany(Lancamento::class, 'servico_id', 'id');
    }
}
