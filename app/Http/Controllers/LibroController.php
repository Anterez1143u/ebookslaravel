<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Calificacion;

class LibroController extends Controller
{
    // Método para listar todos los libros
    public function index()
    {
        $libros = Libro::all(); // Obtiene todos los libros de la base de datos
        return view('libros.index', compact('libros'));
    }

    
    public function show($id)
    {
        $libro = Libro::with('autor')->findOrFail($id); // Busca el libro por ID
        return view('libros.show', compact('libro')); // Carga la vista correcta
    }


}