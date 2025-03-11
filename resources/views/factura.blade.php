@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div id="factura">
            <h1 class="text-center text-primary">📜 Factura #{{ $pedido->id }}</h1>
            <p class="text-end fs-5"><strong>Total pagado:</strong> <span class="text-success">${{ number_format($pedido->total, 2) }}</span></p>

            <h2 class="mt-4">📖 Detalles de la compra:</h2>
            <ul class="list-group mb-4">
                @foreach($pedido->detalles as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">{{ $item->libro->titulo }}</h6>
                            <small class="text-muted">{{ $item->cantidad }} unidades - ${{ number_format($item->precio, 2) }} c/u</small>
                        </div>
                        <strong class="text-success">${{ number_format($item->precio * $item->cantidad, 2) }}</strong>
                        @if($item->formato === 'digital')
                            <a href="{{ asset('storage/' . $item->libro->archivo_pdf) }}" class="btn btn-outline-primary btn-sm ms-3" download>📥 Descargar PDF</a>
                        @endif
                    </li>
                @endforeach
            </ul>

            <h2>📦 Pedidos Físicos:</h2>
            <ul class="list-group">
                @foreach($pedido->detalles as $item)
                    @if($item->formato === 'fisico')
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $item->libro->titulo }} - Cantidad: {{ $item->cantidad }}</span>
                            <span class="badge bg-info text-dark">Estado: {{ ucfirst($item->pedido->estado) }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Botones de acción -->
        <div class="mt-4 d-flex justify-content-between">
            <a href="/" class="btn btn-secondary">🏠 Volver a la tienda</a>
            <button onclick="imprimirFactura()" class="btn btn-primary">🖨️ Imprimir Factura</button>
        </div>
    </div>
</div>

<script>
    function imprimirFactura() {
        let contenido = document.getElementById("factura").innerHTML;
        let ventana = window.open('', '', 'width=800,height=600');
        ventana.document.write('<html><head><title>Factura</title>');
        ventana.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
        ventana.document.write('</head><body class="p-4">' + contenido + '</body></html>');
        ventana.document.close();
        ventana.print();
    }
</script>
@endsection
