@extends('layouts.admin')

@section('contenido')
<div class="container-form">
    <h1 class="text-center mb-4">Listado de Libros</h1>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-custom">
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libros as $libro)
                    <tr>
                        <td>{{ $libro->id }}</td>
                        <td>{{ $libro->titulo }}</td>
                        <td>{{ $libro->autor->name }}</td>
                        <td>
                            <a href="{{ route('libros.detallesAdmin', $libro->id) }}" class="btn btn-success w-100">
                                Ver Detalles
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-3">
        {{ $libros->links() }}
    </div>
</div>
@endsection
