<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    /**
     * Mostrar el carrito de compras.
     */
    public function index()
    {
        $carrito = Session::get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    /**
     * Agregar un libro al carrito.
     */
    public function agregar(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);

        $carrito = Session::get('carrito', []);

        // Clave única: libro_id + formato
        $clave = $id . '-' . $request->formato;

        if (isset($carrito[$clave])) {
            $carrito[$clave]['cantidad'] += $request->cantidad;
        } else {
            $carrito[$clave] = [
                'id' => $libro->id,
                'titulo' => $libro->titulo,
                'portada' => $libro->portada,
                'precio' => $libro->precio,
                'formato' => $request->formato, // Digital o físico
                'cantidad' => $request->cantidad
            ];
        }

        Session::put('carrito', $carrito);
        return redirect()->route('carrito.index')->with('success', 'Libro agregado al carrito.');
    }

    /**
     * Actualizar la cantidad de un libro en el carrito.
     */
    public function actualizar(Request $request, $clave)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$clave])) {
            $carrito[$clave]['cantidad'] = $request->cantidad;
            Session::put('carrito', $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Cantidad actualizada.');
    }

    /**
     * Eliminar un libro del carrito.
     */
    public function eliminar($clave)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$clave])) {
            unset($carrito[$clave]);
            Session::put('carrito', $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Libro eliminado del carrito.');
    }

    /**
     * Vaciar el carrito.
     */
    public function vaciar()
    {
        Session::forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }
}
