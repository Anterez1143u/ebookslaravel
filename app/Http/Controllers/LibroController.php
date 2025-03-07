<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::all(); // Obtiene todos los libros de la base de datos
        return view('libros.index', compact('libros'));
    }
    public function show(Libro $libro) {
        return view('libros.detalles', compact('libro'));
    }

}
