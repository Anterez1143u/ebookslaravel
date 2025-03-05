<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Libro extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'precio', 'categoria', 'portada', 'archivo_pdf'];

    // Relación con el autor
    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    // Relación con calificaciones (asegúrate de que el modelo se llama Calificacion)
    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'libro_id');
    }

    // Relación con comentarios (si los comentarios están en la misma tabla de calificaciones)
    public function comentarios()
    {
        return $this->hasMany(Calificacion::class, 'libro_id');
    }

}
