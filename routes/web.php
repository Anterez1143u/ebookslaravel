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

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Admin
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios');
    Route::post('/admin/usuarios/{id}/asignar-rol', [UserController::class, 'asignarRol'])->name('admin.usuarios.asignar-rol');
    Route::get('/admin/libros', [LibroController::class, 'indexAdmin'])->name('libros.admin');
    Route::get('/admin/asignar-repartidor', [PedidoController::class, 'vistaAsignarRepartidor'])->name('admin.asignarRepartidor');
    Route::post('/admin/asignar-repartidor/{id}', [PedidoController::class, 'asignarRepartidorGuardar'])->name('pedidos.asignarRepartidorGuardar');

    // Analista (agrega aquí las rutas exclusivas para Analista)

    // Escritor
    Route::get('/escritor', [LibrosAdminController::class, 'InicioEscritor'])->name('escritor.inicio');
    Route::get('/escritor/resenas', [EscritorController::class, 'misResenas'])->name('escritor.resenas');

    // Repartidor
    Route::get('/repartidor/mis-pedidos', [PedidoController::class, 'misPedidos'])->name('repartidor.misPedidos');
    Route::put('/repartidor/pedido/{id}/estado', [PedidoController::class, 'actualizarEstado'])->name('repartidor.actualizarEstado');

    // Usuario (agrega aquí las rutas exclusivas para Usuario)

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/actualizar/{clave}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{clave}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

    // Checkout y facturación
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::post('/process-payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/factura/{id}', [FacturaController::class, 'mostrar'])->name('factura.mostrar');
    Route::get('/pedidos/{id}/datos-fisico', [PedidoController::class, 'datosFisico'])->name('pedidos.datosFisico');
    Route::post('/pedidos/{id}/procesar-fisico', [PedidoController::class, 'procesarFisico'])->name('pedidos.procesarFisico');
    Route::get('/pedidos/{id}/detalles', [PedidoController::class, 'detalles'])->name('pedidos.detalles');

    // Otros
    Route::resource('libros', LibrosAdminController::class); // <-- DEJA SOLO ESTA PARA CRUD DE LIBROS
    // Si necesitas detalles admin, usa un prefijo diferente:
    Route::get('/admin/libros/{libro}', [LibroController::class, 'Mostrar'])->name('libros.detallesAdmin');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/libros/{id}/calificar', [CalificacionController::class, 'store'])->name('libros.calificar');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Rutas públicas
Route::get('/', [LibroController::class, 'index'])->name('libros.index');
Route::get('/libros', [LibroController::class, 'index'])->name('libros');
Route::get('/librosLector/{libro}', [LibroController::class, 'show'])->name('libros.detalles');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');