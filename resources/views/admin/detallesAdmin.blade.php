@extends('layouts.admin')

@section('title', 'Detalles del Libro')

@section('contenido')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-5">
            <img src="{{asset('storage/' . $libro->portada)}}" class="img-fluid rounded shadow" alt="{{ $libro->titulo }}">
        </div>
        <div class="col-md-7">
            <h1 class="mb-3">{{ $libro->titulo }}</h1>
            <h5 class="text-muted">Autor: {{ $libro->autor->name }}</h5>
            <p class="mt-3">{{ $libro->descripcion }}</p>
            <h4 class="mt-4 text-success">${{ number_format($libro->precio, 2) }}</h4>

            <form action="{{ route('carrito.agregar', ['id' => $libro->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                <a href="{{ asset('storage/' . $libro->archivo_pdf) }}" download>📥 Descargar PDF</a>
                <a href="{{ route('libros.admin') }}" class="btn btn-primary mt-2">Volver</a>

              
            </form>
        </div>
    </div>
</div>
@endsection
