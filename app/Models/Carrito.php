<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carritos';

    protected $fillable = [
        'cliente_id',
        'libro_id',
        'formato',
        'cantidad',
        'precio_unitario',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
