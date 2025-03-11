@extends('layouts.admin')

@section('contenido')
<div class="container-form">
    <h1 class="text-center  mb-4">Asignar Repartidor a Pedidos Físicos</h1>

    <div class="table-responsive shadow-sm p-3 bg-white rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="thead-custom">
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Libros</th>
                    <th>Fecha de Entrega</th>
                    <th>Repartidor</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    @if($pedido->detalles->where('formato', 'fisico')->count() > 0)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->user->name }}</td>
                            <td>
                                <span class="badge bg-{{ $pedido->estado == 'Pendiente' ? 'warning' : 'success' }}">
                                    {{ $pedido->estado }}
                                </span>
                            </td>
                            <td>
                                <ul class="mb-0">
                                    @foreach($pedido->detalles as $detalle)
                                        @if($detalle->formato === 'fisico')
                                            <li>{{ $detalle->libro->titulo }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $pedido->fecha_entrega ?? 'No asignada' }}</td>
                            <td>{{ $pedido->repartidor->name ?? 'No asignado' }}</td>
                            <td>
                                <form action="{{ route('pedidos.asignarRepartidorGuardar', $pedido->id) }}" method="POST" class="d-flex flex-column">
                                    @csrf
                                    <select name="repartidor_id" class="form-select">
                                        <option value="">Seleccionar...</option>
                                        @foreach($repartidores as $repartidor)
                                            <option value="{{ $repartidor->id }}">{{ $repartidor->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="date" name="fecha_entrega" class="form-control mt-2" required value="{{ $pedido->fecha_entrega }}">
                                    <button type="submit" class="btn btn-success mt-2">Asignar</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $pedidos->links() }}
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.usuarios') }}" class="btn btn-success">Volver</a>
    </div>
</div>
@endsection
