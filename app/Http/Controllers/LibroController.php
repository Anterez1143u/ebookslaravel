<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::with('autor')->Simplepaginate(3);
        return view('libros.index', compact('libros'));
    }
    public function show(Libro $libro) {
        return view('libros.detalles', compact('libro'));
    }
    public function indexAdmin()
    {
        $libros = Libro::Simplepaginate(5);
      
        return view('admin.libros', compact('libros'));
    }
    public function Mostrar(Libro $libro) {
        return view('Admin.detallesAdmin', compact('libro'));
    }
    
}
