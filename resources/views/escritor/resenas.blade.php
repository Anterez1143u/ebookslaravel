@extends('layouts.escritor')

@section('title', 'Reseñas de Mis Libros')

@section('contenido')
    <h1 class="text-center mb-4">Reseñas de Mis Libros</h1>

    @foreach ($libros as $libro)
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ $libro->titulo }}</h5>
            </div>
            <div class="card-body">
                @if($libro->calificaciones->isEmpty())
                    <p>No hay reseñas para este libro.</p>
                @else
                    @foreach ($libro->calificaciones as $calificacion)
                        <div class="border p-3 mb-3">
                            <p><strong>Usuario:</strong> {{ $calificacion->user->name }}</p>
                            <p><strong>Calificación:</strong> {{ $calificacion->puntuacion }} / 5</p>
                            <p><strong>Comentario:</strong> {{ $calificacion->comentario }}</p>
                            <p class="text-muted"><small>{{ $calificacion->created_at->format('d/m/Y') }}</small></p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
@endsection
