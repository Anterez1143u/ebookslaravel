@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Carrito de Compras</h1>

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
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
                            <td>{{ $item['titulo'] }}</td>
                            <td>{{ ucfirst($item['formato']) }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td>${{ number_format($item['precio'], 2) }}</td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <form action="{{ route('carrito.eliminar', $key) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-warning">
                        <td colspan="4" class="text-end"><strong>Total a Pagar:</strong></td>
                        <td><strong>${{ number_format($total, 2) }}</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('carrito.vaciar') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Vaciar Carrito</button>
            </form>
            <a href="{{ route('libros.index') }}" class="btn btn-secondary">Seguir Comprando</a>
            <a href="{{ route('checkout') }}" class="btn btn-success">Finalizar Compra</a>

           
        </div>

    @else
        <div class="alert alert-info text-center">
            <h4>Tu carrito está vacío</h4>
            <a href="{{ route('libros.index') }}" class="btn btn-primary mt-3">Ver Libros</a>
        </div>
    @endif
</div>
@endsection
