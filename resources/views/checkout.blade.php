@extends('layouts.app')

@section('title', 'Pago con Stripe')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Resumen del Pedido</h1>

    <div class="card-pago shadow p-4">
        <ul class="list-group mb-3">
        <h4 class="mb-1">Titulos:</h4>
            @foreach ($carrito as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                
                    <div>
                    
                        <h6 class="mb-1">{{ $item['titulo'] }}</h6> <!-- Nombre del libro en negrita -->
                        <small class="text-muted">{{ $item['cantidad'] }} x ${{ number_format($item['precio'], 2) }}</small> 
                    </div>
                </div>
                <strong class="text-success fs-6">${{ number_format($item['cantidad'] * $item['precio'], 2) }}</strong> 
            </li>

            @endforeach
        </ul>

        <h3 class="text-end">Total a pagar: <strong>${{ number_format($total, 2) }}</strong></h3>

        <form action="{{ route('payment.process') }}" method="POST" class="text-center mt-3">
            @csrf
            <input type="hidden" name="amount" value="{{ $total }}">
            <script
                src="https://checkout.stripe.com/checkout.js"
                class="stripe-button"
                data-key="{{ config('services.stripe.key') }}"
                data-amount="{{ $total * 100 }}" 
                data-name="Mi Tienda"
                data-description="Pago de libros"
                data-currency="cop">
            </script>
        </form>
    </div>
</div>
@endsection
