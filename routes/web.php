<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibrosAdminController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Auth;


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
Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.detalles');



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
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout'); // Página de pago




