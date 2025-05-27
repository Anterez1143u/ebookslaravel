<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1B365D;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" style="color: #F4C95D;" href="{{ route('libros.index') }}">Ebooks</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    {{-- Admin --}}
                    @if(auth()->user()->role && auth()->user()->role->name === 'Admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Panel Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.usuarios') }}">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('libros.admin') }}">Libros</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.asignarRepartidor') }}">Asignar Repartidor</a></li>
                    @endif

                    {{-- Analista --}}
                    @if(auth()->user()->role && auth()->user()->role->name === 'Analista')
                        <li class="nav-item"><a class="nav-link" href="#">Panel Analista</a></li>
                    @endif

                    {{-- Escritor --}}
                    @if(auth()->user()->role && auth()->user()->role->name === 'Escritor')
                        <li class="nav-item"><a class="nav-link" href="{{ route('escritor.inicio') }}">Panel Escritor</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('escritor.resenas') }}">Mis Reseñas</a></li>
                    @endif

                    {{-- Repartidor --}}
                    @if(auth()->user()->role && auth()->user()->role->name === 'Repartidor')
                        <li class="nav-item"><a class="nav-link" href="{{ route('repartidor.misPedidos') }}">Mis Pedidos</a></li>
                    @endif

                    {{-- Usuario --}}
                    @if(auth()->user()->role && auth()->user()->role->name === 'Usuario')
                        <li class="nav-item"><a class="nav-link" href="{{ route('libros') }}">Catálogo</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('carrito.index') }}">Carrito</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pedidos.index') }}">Mis Pedidos</a></li>
                    @endif

                    {{-- Común para todos los autenticados --}}
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit" style="color: #F4C95D;">Cerrar sesión</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('libros.index') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
