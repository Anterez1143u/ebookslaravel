<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Libro;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Carrito::where('cliente_id', Auth::id())->get();
        return view('carrito.index', compact('carrito'));
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'formato' => 'required|in:digital,físico',
            'cantidad' => 'required|integer|min:1',
        ]);

        $libro = Libro::findOrFail($request->libro_id);
        
        Carrito::create([
            'cliente_id' => Auth::id(),
            'libro_id' => $libro->id,
            'formato' => $request->formato,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $libro->precio,
        ]);

        return redirect()->route('carrito.index')->with('success', 'Libro añadido al carrito.');
    }
}
