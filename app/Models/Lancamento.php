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
        'tipo',
        'usuario_id',
    ];
    
    protected $appends = [
        'preco_total',
        'items_string',
    ];
    
    public function usuario ()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
    
    public function itens ()
    {
        return $this->belongsToMany(Item::class, 'lancamentos_items');
    }
    
    public function getItemsStringAttribute ()
    {
        $items = '';
        $total = $this->itens->count();
        $count = 1;
        
        foreach ($this->itens as $item) {
            if ($count === $total) {
                $items .= "{$item->nome}";
            } else {
                $items .= "{$item->nome}, ";
            }
            
            $count++;
        }
        
        return $items;
    }
    
    public function getPrecoTotalAttribute ()
    {
        $total = 0;
        for ($i = 1; $i <= $this->attributes['quantidade']; $i++) {
            foreach ($this->itens as $item) {
                $total += $item->preco;
            }
        }
        
//        dd($total);
        
        return $total;
    }
}
