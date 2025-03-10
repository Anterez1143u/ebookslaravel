<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Auth;

class EscritorController extends Controller
{
    // Mostrar las reseñas de los libros del escritor
    public function misResenas()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener los libros del escritor con sus reseñas y el usuario que las hizo
        $libros = Libro::where('autor_id', $user->id)
                        ->with('calificaciones.user')
                        ->get();

        return view('escritor.resenas', compact('libros'));
    }
}
