@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
    <div class="card">
        <div class="card-body">
            <h4>📚 Libro: {{ $pedido->detalles->first()->libro->titulo }}</h4>
            <p><strong>Formato:</strong> Físico</p>
            <p><strong>Dirección de envío:</strong> {{ $pedido->direccion_envio ?? 'No registrada' }}</p>
            <p><strong>Teléfono:</strong> {{ $pedido->telefono ?? 'No registrado' }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">🔙 Volver a Mis Pedidos</a>
        </div>
    </div>
</div>
@endsection
