@extends('layouts.app')

@section('title', 'Lista de Libros')

@section('content')
    <div class="container" style="margin-top: 90px;">
        <h1 class="text-center mb-4 text-titulo" style="font-size:2.2rem; letter-spacing:1px;">
            <span style="color:#1B365D;">📚 Catálogo de Libros</span>
        </h1>
        <div class="row">
            @foreach($libros as $libro)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100 shadow-lg border-0 rounded-4" style="transition:transform .15s;">
                        <img src="{{ asset('storage/' . $libro->portada) }}" class="card-img-top img-fluid"
                            alt="Portada del libro"
                            style="height:320px; object-fit:cover; border-radius: 14px 14px 0 0;">
                        <div class="card-body d-flex flex-column px-4 py-3" style="background:#fff;">
                            <h5 class="card-title text-titulo mb-1" style="font-size:1.25rem;">{{ $libro->titulo }}</h5>
                            <p class="card-text text-muted mb-2" style="font-size:1rem;">
                                <i class="bi bi-person" style="color:#F4C95D;"></i>
                                <span style="color:#1B365D;">{{ $libro->autor->name }}</span>
                            </p>
                            <div class="mb-2">
                                @if($libro->categoria)
                                    <span class="badge rounded-pill" style="background:#F4C95D; color:#1B365D;">
                                        {{ $libro->categoria }}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('libros.detalles', $libro->id) }}"
                                   class="btn btn-primary w-100"
                                   style="background:#1B365D; border:none; font-weight:600;">
                                    <i class="bi bi-book"></i> Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $libros->links() }}
        </div>
    </div>
@endsection
