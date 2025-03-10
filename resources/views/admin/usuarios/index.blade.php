@extends('layouts.admin')

@section('contenido')
<div class="container">
    <h2 class="mb-4">Gestión de Usuarios</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol Actual</th>
                <th>Asignar Nuevo Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->role->name ?? 'Sin rol' }}</td>
                    <td>
                        <form action="{{ route('admin.usuarios.asignar-rol', $usuario->id) }}" method="POST">
                            @csrf
                            <select name="role_id" class="form-select d-inline w-auto">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $usuario->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Asignar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
