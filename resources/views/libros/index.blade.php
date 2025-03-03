@extends('layouts.app')

@section('title', 'Lista de Libros')

@section('content')
    <h1 class="text-center mb-4">Lista de Libros</h1>
    <div class="row">
        @foreach($libros as $libro)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $libro->imagen }}" class="card-img-top" alt="{{ $libro->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $libro->titulo }}</h5>
                        <p class="card-text text-muted">{{ $libro->autor }}</p>
                        <button class="btn btn-danger w-100">Ver Detalles</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
