<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model {
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'autor_id', 'categoria', 'portada', 'archivo_pdf', 'precio'
    ];

    public function autor() {
        return $this->belongsTo(User::class, 'autor_id');
    }
}