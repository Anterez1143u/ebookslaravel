<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/escritor.css') }}">
</head>

<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('escritor.inicio') }}">
                <i class="bi bi-journal-bookmark-fill"></i> Panel del Escritor
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex flex-column flex-lg-row align-items-lg-center">
                    <!-- Botón Ver Reseñas -->
                    <a href="{{ route('escritor.resenas') }}" class="btn btn-outline-light mb-2 mb-lg-0 me-lg-3 w-100 w-lg-auto">
                        <i class="bi bi-star-fill"></i> Ver Reseñas
                    </a>

                    <!-- Botón Cerrar Sesión -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline w-100 w-lg-auto">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 w-lg-auto">
                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mt-5 pt-4">
        @yield('contenido')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
