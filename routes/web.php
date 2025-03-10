<?php
use App\Http\Controllers\CalificacionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibrosAdminController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EscritorController; 
Auth::routes();

//Creacion de libros
Route::middleware('auth')->group(function () {
    Route::resource('libros', LibrosAdminController::class);
    
});
//Escritor
Route::get('/escritor', [LibrosAdminController::class, 'InicioEscritor'])->name('escritor.inicio');
// libros cliente
Route::get('/libros', [LibroController::class, 'index'])->name('libros');
Route::get('/', [LibroController::class, 'index'])->name('libros.index');
Route::get('/librosLector/{libro}', [LibroController::class, 'show'])->name('libros.detalles');



// Procesar formularios
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{clave}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{clave}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');







Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout'); // Página del pago
Route::post('/process-payment', [PaymentController::class, 'process'])->name('payment.process'); // Procesa el pago
Route::get('/factura/{id}', [FacturaController::class, 'mostrar'])->name('factura.mostrar');

Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index')->middleware('auth');
Route::get('/pedidos/{id}/datos-fisico', [PedidoController::class, 'datosFisico'])->name('pedidos.datosFisico');
Route::post('/pedidos/{id}/procesar-fisico', [PedidoController::class, 'procesarFisico'])->name('pedidos.procesarFisico');
Route::get('/pedidos/{id}/detalles', [PedidoController::class, 'detalles'])->name('pedidos.detalles');

Route::get('/admin/asignar-repartidor', [PedidoController::class, 'vistaAsignarRepartidor'])->name('admin.asignarRepartidor');


Route::post('/admin/asignar-repartidor/{id}', [PedidoController::class, 'asignarRepartidorGuardar'])
    ->name('pedidos.asignarRepartidorGuardar');
    Route::get('/admin/libros', [LibroController::class, 'indexAdmin'])->name('libros.admin');

   
        Route::get('/repartidor/mis-pedidos', [PedidoController::class, 'misPedidos'])->name('repartidor.misPedidos');
        Route::put('/repartidor/pedido/{id}/estado', [PedidoController::class, 'actualizarEstado'])->name('repartidor.actualizarEstado');
        Route::get('/libros/{libro}', [LibroController::class, 'Mostrar'])->name('libros.detallesAdmin');
        Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios');
        Route::post('/admin/usuarios/{id}/asignar-rol', [UserController::class, 'asignarRol'])->name('admin.usuarios.asignar-rol');
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('admin.index');

        Route::post('/libros/{id}/calificar', [CalificacionController::class, 'store'])
    ->middleware('auth')
    ->name('libros.calificar');
    Route::get('/escritor/resenas', [EscritorController::class, 'misResenas'])->name('escritor.resenas');
