<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use SoftDeletes;
    
    protected $table = 'lancamentos';
    
    protected $fillable = [
        'quantidade',
        'tipo',
        'usuario_id',
        'produto_id',
        'servico_id',
    ];
    
    protected $appends = [
        'preco_total'
    ];
    
    public function usuario ()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
    
    public function item ()
    {
        if ($this->attributes['produto_id']) {
            return $this->belongsTo(Produto::class, 'produto_id', 'id');
        }
        
        return $this->belongsTo(Servico::class, 'servico_id', 'id');
    }
    
    public function getPrecoTotalAttribute ()
    {
        $total = 0;
        for ($i = 1; $i <= $this->attributes['quantidade']; $i++) {
            $total += $this->item->preco;
        }
        
        return $total;
    }
}
