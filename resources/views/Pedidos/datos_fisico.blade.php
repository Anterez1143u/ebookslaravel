@extends('layouts.app')

@section('content')
<div class="container-form">
    <h1>Información de Envío</h1>
    <form action="{{ route('pedidos.procesarFisico', $pedido->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección de Envío</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar Envío y Generar Factura</button>
    </form>
</div>
@endsection
