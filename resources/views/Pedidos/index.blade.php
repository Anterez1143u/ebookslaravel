@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Pedidos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Libro</th>
                <th>Formato</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                @foreach($pedido->detalles as $detalle)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $detalle->libro->titulo }}</td>
                        <td>{{ $detalle->formato }}</td>
                        <td>
                        @if($detalle->formato === 'digital' && $detalle->libro->archivo_pdf)
                                <br><a href="{{ asset('storage/' . $detalle->libro->archivo_pdf) }}" download>📥 Descargar PDF</a>
                            @elseif($detalle->formato === 'fisico')
                                <a href="{{ route('pedidos.detalles', $pedido->id) }}" class="btn btn-primary">Ver detalles</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
