@extends('layouts.admin')

@section('contenido')
<div class="container-form">
    <h1 class="mb-4 text-center">Panel de Administración</h1>

    <div class="row">
        <!-- Gestión de Pedidos -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Gestión de Pedidos</h5>
                </div>
                <div class="card-body">
                    <p>Asigna repartidores a los pedidos con libros físicos.</p>
                    <a href="{{ route('admin.asignarRepartidor') }}" class="btn btn-outline-success w-100">Gestionar Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Gestión de Usuarios -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-dark">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Gestión de Usuarios</h5>
                </div>
                <div class="card-body">
                    <p>Administra los usuarios y asigna roles.</p>
                    <a href="{{ route('admin.usuarios') }}" class="btn btn-outline-dark w-100">Gestionar Usuarios</a>
                </div>
            </div>
        </div>

        <!-- Gestión de Libros -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-secondary">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Gestión de Libros</h5>
                </div>
                <div class="card-body">
                    <p>Consulta todos los libros disponibles.</p>
                    <a href="{{ route('libros.admin') }}" class="btn btn-outline-secondary w-100">Ver Libros</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
