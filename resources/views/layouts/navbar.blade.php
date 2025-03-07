<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="navbar-container">
        <a class="navbar-brand" >
       
            <i class="bi bi-book-half"></i> Biblioteca
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('libros.index') }}">
                        <i class="bi bi-journal-bookmark"></i> Libros
                    </a>
                </li>
                @auth
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('carrito.index') }}">
                        <i class="bi bi-cart3"></i> Carrito
                    </a>
                </li>
                <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="nav-link text-danger bg-transparent border-0">
        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
    </button>
</form>

        @else
        
        <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">
        <i class="bi bi-person-circle"></i> Iniciar Sesión
    </a>
</li>
    </form>
    @endauth
</li>
            </ul>
        </div>
    </div>
</nav>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
