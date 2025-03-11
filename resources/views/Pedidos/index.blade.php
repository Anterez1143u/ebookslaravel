@extends('layouts.app')


@section('content')
<div class="container mt-4">
    <h1 class="mb-4 ">📚 Mis Pedidos</h1>

    <div class="card shadow-lg p-4">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-custom">
                    <tr>
                        <th># Pedido</th>
                        <th>Libro</th>
                        <th>Formato</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        @foreach($pedido->detalles as $detalle)
                            <tr>
                                <td class="fw-bold">#{{ $pedido->id }}</td>
                                <td>{{ $detalle->libro->titulo }}</td>
                                <td>
                                    <span class="badge {{ $detalle->formato === 'digital' ? 'bg-info' : 'bg-warning' }}">
                                        {{ ucfirst($detalle->formato) }}
                                    </span>
                                </td>
                                <td>
                                    @if($detalle->formato === 'digital' && $detalle->libro->archivo_pdf)
                                        <a href="{{ asset('storage/' . $detalle->libro->archivo_pdf) }}" class="btn btn-outline-success btn-sm" download>📥 Descargar PDF</a>
                                    @elseif($detalle->formato === 'fisico')
                                        <a href="{{ route('pedidos.detalles', $pedido->id) }}" class="btn btn-primary btn-sm">📦 Ver detalles</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
    <nav aria-label="Paginación">
        <ul class="pagination pagination-sm"> <!-- Agrega pagination-sm para hacerla más pequeña -->
            {{ $pedidos->links() }}
        </ul>
    </nav>
</div>
        </div>
    </div>
</div>
@endsection
