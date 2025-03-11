@extends('layouts.repartidor')

@section('contenido')
<div class="container">
    <h2 class="mb-4">📦 Mis Pedidos Asignados</h2>

    <table class="table table-striped">
        <thead class="thead-custom">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Libro</th>
                <th>Direccion</th>
                
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
                      
                            {{ $pedido->direccion_envio }} <br>
                       
                    </td>
                    <td>{{ $pedido->fecha_entrega ?? 'No asignada' }}</td>
                    <td>
                        <span class="badge 
                            {{ $pedido->estado == 'Entregado' ? 'bg-success' : ($pedido->estado == 'Cancelado' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $pedido->estado }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('repartidor.actualizarEstado', $pedido->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="estado" class="form-select">
                                <option value="Entregado">Entregado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm mt-2">Actualizar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Agregar paginación -->
    <div class="d-flex justify-content-center">
        {{ $pedidos->links() }}
    </div>
</div>
@endsection
