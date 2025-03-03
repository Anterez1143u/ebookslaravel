<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibroController;

Route::get('/libros', [LibroController::class, 'index'])->name('libros');
Route::get('/', [LibroController::class, 'index'])->name('libros.index');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesar formularios
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Página protegida (Dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');