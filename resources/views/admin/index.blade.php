@extends('layouts.admin')

@section('contenido')
<div class="container">
    <h2 class="mb-4">Panel de Administración</h2>

    <div class="row">
        <!-- Gestión de Pedidos -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Gestión de Pedidos
                </div>
                <div class="card-body">
                    <p>Asigna repartidores a los pedidos con libros físicos.</p>
                    <a href="{{ route('admin.asignarRepartidor') }}" class="btn btn-primary">Gestionar Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Gestión de Usuarios -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Gestión de Usuarios
                </div>
                <div class="card-body">
                    <p>Administra los usuarios y asigna roles.</p>
                    <a href="{{ route('admin.usuarios') }}" class="btn btn-success">Gestionar Usuarios</a>
                </div>
            </div>
        </div>

        <!-- Gestión de Libros -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    Gestión de Libros
                </div>
                <div class="card-body">
                    <p>Consulta todos los libros disponibles.</p>
                    <a href="{{ route('libros.admin') }}" class="btn btn-warning">Ver Libros</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
