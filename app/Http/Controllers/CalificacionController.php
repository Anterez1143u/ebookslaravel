<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Libro;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    public function store(Request $request, $libro_id)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:500',
        ]);

        Calificacion::create([
            'user_id' => Auth::id(),
            'libro_id' => $libro_id,
            'puntuacion' => $request->puntuacion,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('libros.detalles', $libro_id)->with('success', 'Reseña enviada correctamente.');
    }
}

