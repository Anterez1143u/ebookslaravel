@extends('layouts.app')

@section('title', 'Detalles del Libro')

@section('content')
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

                <!-- Selección de formato -->
                <div class="mb-3">
                    <label for="formato" class="form-label">Formato</label>
                    <select name="formato" id="formato" class="form-control" required>
                        <option value="digital">Digital</option>
                        <option value="fisico">Físico</option>
                    </select>
                </div>

                <!-- Selección de cantidad -->
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="1" required>
                </div>

                <!-- Botones -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                    <a href="{{ route('carrito.index') }}" class="btn btn-secondary">Ver Carrito</a>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- Formulario para calificar -->
 @auth
    <div class="card mt-4">
        <div class="card-header">Calificar este libro</div>
        <div class="card-body">
            <form action="{{ route('libros.calificar', $libro->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="puntuacion" class="form-label">Puntuación (1-5)</label>
                    <select name="puntuacion" id="puntuacion" class="form-control">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea name="comentario" id="comentario" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Reseña</button>
            </form>
        </div>
    </div>
    @endauth

    <!-- Mostrar calificaciones -->
    <div class="mt-4">
        <h4>Reseñas:</h4>
        @forelse($libro->calificaciones as $calificacion)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $calificacion->user->name }}</strong> - 
                    <span>{{ $calificacion->puntuacion }} ⭐</span>
                    <p>{{ $calificacion->comentario }}</p>
                </div>
            </div>
        @empty
            <p>Aún no hay calificaciones para este libro.</p>
        @endforelse
    </div>
</div>
@endsection
