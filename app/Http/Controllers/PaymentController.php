<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Session;
use App\Models\Pedido;
use App\Models\Factura;

class PaymentController extends Controller
{
    public function checkout()
    {
        $carrito = Session::get('carrito', []);
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        return view('checkout', compact('carrito', 'total'));
    }

    public function process(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));


       
        try {

      

            $charge = Charge::create([
                "amount" => intval($request->input('amount')) * 100, // ✅ Multiplica por 100
                "currency" => "cop", // ✅ Asegura que la moneda sea COP
                "source" => $request->stripeToken,
                "description" => "Pago de libros"
            ]);
            // Obtener el carrito
            $carrito = Session::get('carrito', []);
            $soloDigital = true;
            // Crear el pedido (se usará como "factura")
            $pedido = new Pedido();
            $pedido->usuario_id = auth()->id();
            $pedido->total = $request->input('amount');
            $pedido->estado = 'Pendiente'; // Estado inicial
            $pedido->save();
    
            // Guardar los detalles de los productos comprados
            foreach ($carrito as $item) {
                $pedido->detalles()->create([
                    'libro_id' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                    'formato' => $item['formato'] // 'digital' o 'físico'
                ]);
            }
            if (isset($item['formato']) && strtolower($item['formato']) === 'fisico') {
                $soloDigital = false;
            }

    
            // Limpiar el carrito después del pago
            Session::forget('carrito');
    
            // Redirigir a la "factura" usando el ID del pedido
            if ($soloDigital) {
            return redirect()->route('factura.mostrar', $pedido->id)->with('success', 'Pago realizado con éxito.');
        } else {
            // Si hay productos físicos, pedir los datos de envío
            return redirect()->route('pedidos.datosFisico', $pedido->id)->with('info', 'Ingrese los datos de envío antes de generar la factura.');
        }
    
        } catch (\Exception $e) {
            dd($e->getMessage()); // Esto imprimirá el error y detendrá la ejecución
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        
    }
    
    
}
