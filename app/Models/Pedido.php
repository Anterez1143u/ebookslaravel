<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['usuario_id', 'total', 'estado', 'nombre_cliente', 'direccion_envio', 'telefono'];


    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'pedido_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // Asegúrate de que el campo en la BD es 'user_id'
    }
    public function repartidor()
{
    return $this->belongsTo(User::class, 'repartidor_id');
}
}
