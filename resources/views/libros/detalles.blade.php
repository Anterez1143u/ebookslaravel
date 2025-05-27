@extends('layouts.app')

@section('title', 'Detalles del Libro')

@section('content')
<div class="container mt-5">
    <div class="row g-4">
        <div class="col-md-5">
            <div class="bg-white rounded-4 shadow p-3 h-100 d-flex align-items-center justify-content-center">
                <img src="{{ asset('storage/' . $libro->portada) }}" class="img-fluid rounded-4" alt="{{ $libro->titulo }}" style="max-height: 400px; object-fit: contain;">
            </div>
        </div>
        <div class="col-md-7">
            <div class="bg-white rounded-4 shadow p-4 h-100">
                <h1 class="text-titulo mb-2" style="font-size:2rem;">{{ $libro->titulo }}</h1>
                <h5 class="text-muted mb-2">Autor: <span style="color:#1B365D;">{{ $libro->autor->name }}</span></h5>
                <div class="mb-2">
                    @if($libro->categoria)
                        <span class="badge rounded-pill" style="background:#F4C95D; color:#1B365D;">
                            {{ $libro->categoria }}
                        </span>
                    @endif
                </div>
                <p class="text-muted mt-3" style="font-size:1.1rem;">{{ $libro->descripcion }}</p>
                <h4 class="mt-4 text-success" style="font-weight:700;">${{ number_format($libro->precio, 2) }}</h4>

                <form action="{{ route('carrito.agregar', ['id' => $libro->id]) }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="libro_id" value="{{ $libro->id }}">

                    <div class="mb-3">
                        <label for="formato" class="form-label">Formato</label>
                        <select name="formato" id="formato" class="form-select" required>
                            <option value="digital">Digital</option>
                            <option value="fisico">Físico</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="bi bi-cart-plus"></i> Agregar al Carrito
                        </button>
                        <a href="{{ route('carrito.index') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-bag"></i> Ver Carrito
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @auth
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow rounded-4 mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Calificar este libro</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('libros.calificar', $libro->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="puntuacion" class="form-label">Puntuación (1-5)</label>
                            <select name="puntuacion" id="puntuacion" class="form-select">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentario</label>
                            <textarea name="comentario" id="comentario" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Enviar Reseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <h4 class="mb-3">Reseñas:</h4>
            @forelse($libro->calificaciones as $calificacion)
                <div class="card mb-2 shadow-sm">
                    <div class="card-body">
                        <strong>{{ $calificacion->user->name }}</strong> - 
                        <span>{{ $calificacion->puntuacion }} ⭐</span>
                        <p class="mb-0">{{ $calificacion->comentario }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted">Aún no hay calificaciones para este libro.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
