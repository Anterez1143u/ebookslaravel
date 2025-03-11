@extends('layouts.escritor')

@section('contenido')
<div class="container mt-4">
    <h1 class="mb-4 text-titulo">Mis Libros</h1>
    <a href="{{ route('libros.create') }}" class="btn btn-success mb-3">➕ Agregar Libro</a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($libros->isEmpty())
        <div class="alert alert-info text-center">📚 No se encontraron registros.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped text-center">
                <thead class="thead-custom">
                    <tr>
                        <th>Portada</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Libro</th>
                        <th>Fecha de Publicación</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($libros as $libro)
                    <tr>
                        <td>
                            @if($libro->portada)
                                <img src="{{ asset('storage/' . $libro->portada) }}" class="img-thumbnail" width="60">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $libro->titulo }}</td>
                        <td>{{ $libro->categoria }}</td>
                        <td>
                            <a href="{{ asset('storage/' .$libro->archivo_pdf) }}" class="btn btn-info btn-sm" download>
                                📥 Descargar PDF
                            </a>
                        </td>
                        <td>{{ $libro->created_at->format('d/m/Y') }}</td>
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
            <div class="d-flex justify-content-center mt-3">
        {{ $libros->links() }}
    </div>
        </div>
    @endif
</div>
@endsection