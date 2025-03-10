@extends('layouts.admin')

@section('contenido')
<div class="container">
    <h2>Asignar Repartidor a Pedidos Físicos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>libros</th>
                <th>fecha de entrega</th>
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
                        <td>{{ $pedido->estado }}</td>
                        <td>
                        <ul>
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
                        <form action="{{ route('pedidos.asignarRepartidorGuardar', $pedido->id) }}" method="POST">
                            @csrf
                            <select name="repartidor_id" class="form-control">
                                <option value="">Seleccionar...</option>
                                @foreach($repartidores as $repartidor)
                                    <option value="{{ $repartidor->id }}">{{ $repartidor->name }}</option>
                                @endforeach
                            </select>
                            <input type="date" name="fecha_entrega" class="form-control mt-2" required value="{{ $pedido->fecha_entrega }}">
                            <button type="submit" class="btn btn-primary mt-2">Asignar</button>
                        </form>

                        </td>
                    </tr>
                @endif
            @endforeach
        
        </tbody>
    </table>
  
    <a href="{{ route('admin.usuarios') }}" class="btn btn-primary mt-2">Volver</a>
</div>
@endsection
