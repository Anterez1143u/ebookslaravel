<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago con Stripe</title>
</head>
<body>

    <h2>Resumen del pedido</h2>

    <ul>
        @foreach ($carrito as $item)
            <li>{{ $item['titulo'] }} - {{ $item['cantidad'] }} x ${{ $item['precio'] }} = ${{ $item['cantidad'] * $item['precio'] }}</li>
        @endforeach
    </ul>

    <h3>Total a pagar: ${{ $total }}</h3>

    <form action="{{ route('payment.process') }}" method="POST">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}"> <!-- Agrega este input -->
    <script
        src="https://checkout.stripe.com/checkout.js"
        class="stripe-button"
        data-key="{{ config('services.stripe.key') }}"
        data-amount="{{ $total*100 }}" 
        data-name="Mi Tienda"
        data-description="Pago de libros"
        data-currency="cop">
    </script>
</form>


</body>
</html>
