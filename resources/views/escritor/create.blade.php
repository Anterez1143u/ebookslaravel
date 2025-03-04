@extends('layouts.escritor')

@section('contenido')
<div class="container mt-4">
    <h2>Agregar Nuevo Libro</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="portada" class="form-label">Portada (opcional)</label>
            <input type="file" name="portada" class="form-control">
        </div>

        <div class="mb-3">
            <label for="archivo_pdf" class="form-label">Archivo PDF</label>
            <input type="file" name="archivo_pdf" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('escritor.inicio') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
