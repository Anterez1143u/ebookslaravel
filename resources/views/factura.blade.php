<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>
<body>
    <h1>Factura #{{ $pedido->id }}</h1>
    <p>Total pagado: ${{ number_format($pedido->total, 2) }}</p>

    <h2>Detalles:</h2>
    <ul>
        @foreach($pedido->detalles as $item)
            <li>
                {{ $item->libro->titulo }} - {{ $item->cantidad }} unidades - ${{ $item->precio * $item->cantidad }}
                @if($item->formato === 'digital')
                    <br><a href="{{asset('storage/' . $item->libro->archivo_pdf) }}" download>📥 Descargar PDF</a>
                @endif
            </li>
        @endforeach
    </ul>

    <h2>📦 Pedidos Físicos:</h2>
    <ul>
        @foreach($pedido->detalles as $item)
            @if($item->formato === 'fisico')
                <li>{{ $item->libro->titulo }} - Cantidad: {{ $item->cantidad }} - estado:{{$item->pedido->estado}}</li>
            @endif
        @endforeach
    </ul>

    <a href="/">🏠 Volver a la tienda</a>
</body>
</html>
