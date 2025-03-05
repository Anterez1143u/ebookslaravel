<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Calificacion extends Model
{
    protected $table = 'calificaciones'; // 👈 Indica el nombre correcto de la tabla

    protected $fillable = ['libro_id', 'cliente_id', 'calificacion', 'comentario'];

    // Relación con el libro
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    // Relación con el usuario que dejó la calificación
    public function usuario()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }


}
