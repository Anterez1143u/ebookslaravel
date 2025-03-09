<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PedidoController extends Controller
{
    public function index()
    {
        // Obtener los pedidos del usuario autenticado con los libros asociados
        $pedidos = Pedido::with('detalles.libro')->where('usuario_id', Auth::id())->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function descargarPDF($id)
    {
        // Buscar el pedido con el libro asociado
        $pedido = Pedido::with('detalles.libro')->where('usuario_id', Auth::id())->findOrFail($id);

        foreach ($pedido->detalles as $detalle) {
            $libro = $detalle->libro;

            // Verifica si el libro tiene un archivo PDF disponible
            if ($libro->tipo === 'digital' && $libro->archivo_pdf) {
                $rutaArchivo = 'public/' . $libro->archivo_pdf;

                if (Storage::exists($rutaArchivo)) {
                    return response()->download(storage_path("app/$rutaArchivo"), $libro->titulo . '.pdf');
                }
            }
        }

        return redirect()->route('pedidos.index')->with('error', 'No se encontró el archivo PDF.');
    }
    public function datosFisico($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.datos_fisico', compact('pedido'));
    }

    public function procesarFisico(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        // Guardar la información de envío en el pedido
        $pedido->nombre_cliente = $request->nombre;
        $pedido->direccion_envio = $request->direccion;
        $pedido->telefono = $request->telefono;
        $pedido->estado = 'En proceso de envío'; // Actualiza el estado
        $pedido->save();

        // Redirigir a la factura
        return redirect()->route('factura.mostrar', $pedido->id)->with('success', 'Datos de envío guardados. Aquí está tu factura.');
    }
    public function detalles($id)
{
    $pedido = Pedido::with('detalles.libro', 'user')->findOrFail($id);
    return view('pedidos.detalles_pedido', compact('pedido'));
}

}
