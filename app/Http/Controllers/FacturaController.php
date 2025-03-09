<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class FacturaController extends Controller
{
    public function mostrar($id)
    {
        $pedido = Pedido::with('detalles.libro')->findOrFail($id);
        return view('factura', compact('pedido'));
    }
}


