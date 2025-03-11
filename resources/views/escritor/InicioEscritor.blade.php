@extends('layouts.escritor')

@section('contenido')
<div class="container mt-4">
    <h2>Mis Libros</h2>
    <a href="{{ route('libros.create') }}" class="btn btn-primary mb-3">Agregar Libro</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($libros->isEmpty())
        <div class="alert alert-info">No se encontraron registros.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Libro</th>
                    <th>fecha de publicacion</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libros as $libro)
                <tr>
                    <td>
                        @if($libro->portada)
                            <img src="{{ asset('storage/' . $libro->portada) }}" width="50">
                        @else
                            No hay imagen
                        @endif
                    </td>
                   
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->categoria }}</td>
                    <td><a href="{{ asset('storage/' .$libro->archivo_pdf) }}" download>📥 Descargar PDF</a></td>
                    <td>{{ $libro->created_at }}</td>
                    <td>${{ number_format($libro->precio, 2) }}</td>

                    <td>
                        <a href="{{ route('libros.edit', $libro->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
