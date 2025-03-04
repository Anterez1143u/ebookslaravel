<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/escritor.css') }}">
</head>

<body>
    <nav class="navbar ">
        <div class="container">
            <a class="navbar-brand" href="{{ route('escritor.inicio') }}">Panel del Escritor</a>
            <li class="nav-item">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="nav-link text-danger bg-transparent border-0">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </button>
    </form>
</li>

        </div>
    </nav>

    <div class="container">
        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
