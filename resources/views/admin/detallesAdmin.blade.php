@extends('layouts.admin')

@section('title', 'Detalles del Libro')

@section('contenido')
<div class="container-detalle mt-4">
    <div class="row">
        <!-- Imagen del libro -->
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $libro->portada) }}" class="img-fluid rounded shadow" alt="{{ $libro->titulo }}">
        </div>

        <!-- Detalles del libro -->
        <div class="col-md-7">
            <h1 class="mb-3 ">{{ $libro->titulo }}</h1>
            <h5 class="text-muted">Autor: {{ $libro->autor->name }}</h5>
            <h6 class="mt-3">Descripcion:{{ $libro->descripcion }}</h6>
            <h4 class="mt-4 text-success fw-bold">${{ number_format($libro->precio, 2) }}</h4>

            <!-- Botones de acción -->
            <div class="mt-4">
                <a href="{{ asset('storage/' . $libro->archivo_pdf) }}" download class="btn btn-success">
                    📥 Descargar PDF
                </a>
                <a href="{{ route('libros.admin') }}" class="btn btn-success ms-2">
                    ⬅ Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
