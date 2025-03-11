@extends('layouts.escritor')

@section('title', 'Reseñas de Mis Libros')

@section('contenido')
    <div class="container-form mt-4">
        <h1 class="text-center mb-4">Reseñas de Mis Libros</h1>

        @foreach ($libros as $libro)
            <div class="card mb-4 shadow-sm">
                <div class="card-header  text-white">
                    <h5 class="mb-0">{{ $libro->titulo }}</h5>
                </div>
                <div class="card-body">
                    @if ($libro->calificaciones->isEmpty())
                        <p class="text-muted">No hay reseñas para este libro.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($libro->calificaciones as $calificacion)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <span><strong>Usuario:</strong> {{ $calificacion->user->name }}</span>
                                        <small class="text-muted">{{ $calificacion->created_at->format('d/m/Y') }}</small>
                                    </div>
                                    <div class="mt-2">
                                        <strong>Calificación:</strong> 
                                        <span class="text-warning">
                                            {!! str_repeat('<i class="bi bi-star-fill"></i>', $calificacion->puntuacion) !!}
                                            {!! str_repeat('<i class="bi bi-star"></i>', 5 - $calificacion->puntuacion) !!}
                                        </span>
                                    </div>
                                    <p class="mt-2"><strong>Comentario:</strong> {{ $calificacion->comentario }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
