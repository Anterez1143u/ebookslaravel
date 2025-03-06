@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container mt-5">
    <h1>Carrito de Compras</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($carrito->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Libro</th>
                    <th>Formato</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $item)
                    <tr>
                        <td>{{ $item->libro->titulo }}</td>
                        <td>{{ ucfirst($item->formato) }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->precio_unitario, 2) }}</td>
                        <td>${{ number_format($item->cantidad * $item->precio_unitario, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Tu carrito está vacío.</p>
    @endif

    <a href="{{ route('libros') }}" class="btn btn-outline-secondary">Seguir Comprando</a>
</div>
@endsection
