@extends('layouts.escritor')

@section('contenido')
<div class="container-form mt-4">
    <h1>📖 Editar Libro</h1>

    <form action="{{ route('libros.update', $libro->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ $libro->titulo }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $libro->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" class="form-control" value="{{ $libro->categoria }}" required>
        </div>

        <div class="mb-3">
            <label for="portada" class="form-label">Portada</label><br>
            @if($libro->portada)
                <img src="{{ asset('storage/' . $libro->portada) }}" class="img-thumbnail mb-2" width="80">
            @endif
            <input type="file" name="portada" class="form-control">
        </div>

        <div class="mb-3">
            <label for="archivo_pdf" class="form-label">Archivo PDF</label>
            <input type="file" name="archivo_pdf" class="form-control">
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01" value="{{ $libro->precio }}">
        </div>

        <button type="submit" class="btn btn-success">✅ Actualizar</button>
        <a href="{{ route('escritor.inicio') }}" class="btn btn-secondary">❌ Cancelar</a>
    </form>
</div>

@endsection
