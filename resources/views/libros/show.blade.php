@extends('layouts.app')

@section('title', 'Detalles del Libro')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="row g-0">
            @if($libro->portada)
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $libro->portada) }}" class="img-fluid rounded-start" alt="Portada del libro">
                </div>
            @endif
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title text-primary">{{ $libro->titulo }}</h1>
                    <p class="card-text"><strong>Autor:</strong> {{ $libro->autor->name }}</p>
                    <p class="card-text"><strong>Categoría:</strong> {{ $libro->categoria }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $libro->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> <span class="text-success">${{ number_format($libro->precio, 2) }}</span></p>

                    <p class="card-text">
                        <strong>Calificación:</strong> 
                        @if($libro->calificaciones->count() > 0)
                            <span class="text-warning">
                                ⭐ {{ number_format($libro->calificaciones->avg('calificacion'), 1) }}/5
                            </span>
                        @else
                            <span class="text-muted">Sin calificaciones</span>
                        @endif
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('libros') }}" class="btn btn-outline-secondary">Volver</a>

                        <form action="{{ route('carrito.agregar') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                            <input type="hidden" name="formato" value="digital">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary">Comprar Digital</button>
                        </form>

                        <form action="{{ route('carrito.agregar') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                            <input type="hidden" name="formato" value="físico">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-success">Comprar Físico</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de Comentarios --}}
    <div class="mt-5">
        <h3>Comentarios</h3>
        @if($libro->calificaciones->count() > 0)
            <ul class="list-group">
                @foreach($libro->calificaciones as $comentario)
                    <li class="list-group-item">
                        <strong>{{ $comentario->usuario->name }}</strong> 
                        <small class="text-muted">({{ $comentario->created_at->format('d/m/Y') }})</small>
                        <p>{{ $comentario->comentario }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">No hay comentarios aún.</p>
        @endif
    </div>
</div>
@endsection
