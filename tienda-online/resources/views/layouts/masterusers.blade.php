<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LuxuryParfum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand img {
            max-height: 50px;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-custom {
            background-color: rgb(54, 96, 235);
            color: white;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem; /* Espaciado interno para el texto */
            font-size: 1rem; /* Tamaño del texto */
            border-radius: 5px; /* Bordes redondeados */
            display: inline-block; /* Asegura que el botón se ajuste al contenido */
            white-space: nowrap; /* Evita que el texto se parta en varias líneas */
            min-width: auto; /* Deja que el ancho dependa del contenido */
        }

        .btn-custom:hover {
            background-color:rgb(29, 37, 143);
            color: white;
        }

        .form-select, .form-control {
            border-radius: 0.375rem;
        }

        .navbar .form-control {
        max-width: 300px; /* Limita el ancho del campo de búsqueda en pantallas grandes */
        transition: all 0.3s ease-in-out;
        }

        .navbar .form-control:focus {
            max-width: 400px; /* Expande al hacer clic */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .navbar .badge {
            font-size: 0.75rem;
            padding: 0.4em 0.6em;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.webp') }}" alt="LuxuryParfum Logo" style="max-height: 50px;">
            </a>

            <!-- Toggle for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Navigation Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.catalogo') }}">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('privacidad') }}">Privacidad</a>
                    </li>
                </ul>

                <!-- Search Form -->
                <form action="{{ route('productos.catalogo') }}" method="GET" class="d-flex w-100 w-lg-auto me-lg-3">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control me-2" 
                        placeholder="Buscar productos..." 
                        value="{{ request('search') }}" 
                        style="border-radius: 20px; padding: 0.5rem 1rem;">
                    <button type="submit" class="btn btn-outline-primary" style="border-radius: 20px;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- User Actions -->
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        @php
                            $cart = auth()->user()->carts;
                            $cartLines = $cart->lines ?? collect(); // Obtener las líneas del carrito
                        @endphp

                        <!-- Icono del Carrito -->
                        <li class="nav-item me-3">
                            <a class="nav-link position-relative" href="{{ route('carrito.index') }}">
                                <i class="bi bi-cart3" style="font-size: 1.5rem;"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartLines->count() }} <!-- Número de artículos en el carrito -->
                                </span>
                            </a>
                        </li>

                        <!-- Dropdown de Usuario -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- User Name -->
                                {{ Auth::user()->name }}

                                <!-- Profile Image -->
                                <img 
                                    src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('images/no-imagen.webp') }}" 
                                    alt="Profile" 
                                    class="profile-image ms-2" 
                                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                                <li><a class="dropdown-item" href="{{ route('pedido.misPedidos') }}">Mis pedidos</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-custom me-3" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-custom btn-custom" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">© {{ date('Y') }} LuxuryParfum. Todos los derechos reservados.</p>
            <small><a href="{{ route('contacto') }}">Contacto</a> | <a href="{{ route('privacidad') }}">Política de Privacidad</a></small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
