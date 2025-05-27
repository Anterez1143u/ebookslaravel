@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 text-titulo" style="font-size:2rem;">🛒 Carrito de Compras</h1>

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="thead-custom">
                            <tr>
                                <th>Libro</th>
                                <th>Formato</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Total</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('carrito') as $key => $item)
                                @php 
                                    $subtotal = $item['precio'] * $item['cantidad'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item['titulo'] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill" style="background:#F4C95D; color:#1B365D;">
                                            {{ ucfirst($item['formato']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-titulo">{{ $item['cantidad'] }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">${{ number_format($item['precio'], 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold" style="color:#4CAF50;">${{ number_format($subtotal, 2) }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('carrito.eliminar', $key) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-warning">
                                <td colspan="4" class="text-end text-titulo"><strong>Total a Pagar:</strong></td>
                                <td><strong style="color:#1B365D; font-size:1.2rem;">${{ number_format($total, 2) }}</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <form action="{{ route('carrito.vaciar') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-x-circle"></i> Vaciar Carrito
                        </button>
                    </form>
                    <a href="{{ route('libros.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Seguir Comprando
                    </a>
                    <a href="{{ route('checkout') }}" class="btn btn-success">
                        <i class="bi bi-credit-card"></i> Finalizar Compra
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center mt-5">
            <h4 class="mb-3">Tu carrito está vacío</h4>
            <a href="{{ route('libros.index') }}" class="btn btn-primary">
                <i class="bi bi-book"></i> Ver Libros
            </a>
        </div>
    @endif
</div>
@endsection
