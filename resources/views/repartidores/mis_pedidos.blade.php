@extends('layouts.repartidor')

@section('contenido')
<div class="container">
    <h2>Mis Pedidos Asignados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Libro</th>
                <th>Formato</th>
                <th>Fecha de Entrega</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->user->name ?? 'N/A' }}</td>
                    <td>
                        @foreach($pedido->detalles as $detalle)
                            {{ $detalle->libro->titulo }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($pedido->detalles as $detalle)
                            {{ $detalle->formato }} <br>
                        @endforeach
                    </td>
                    <td>{{ $pedido->fecha_entrega ?? 'No asignada' }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>
                        <form action="{{ route('repartidor.actualizarEstado', $pedido->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="estado" class="form-select">
                                <option value="Entregado">Entregado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                            <button type="submit" class="btn btn-success mt-2">Actualizar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
