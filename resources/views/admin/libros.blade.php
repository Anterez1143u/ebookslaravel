@extends('layouts.admin')

@section('contenido')
<div class="container">
    <h2>Listado de Libros</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Portada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor->name }}</td>
                    <td>   <a href="{{ route('libros.detallesAdmin', $libro->id) }}" class="btn btn-danger w-100">Ver Detalles</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
