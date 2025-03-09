<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    protected $fillable = ['pedido_id', 'libro_id', 'cantidad', 'precio', 'formato'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }
}
