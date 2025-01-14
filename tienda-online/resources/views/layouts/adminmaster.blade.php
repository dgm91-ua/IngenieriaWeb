<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi Aplicación')</title>
    
    <!-- Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS (CDN) -->
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
      rel="stylesheet"
    >

    <!-- Opcional: tu hoja de estilos adicional -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Marca o nombre de tu sitio -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Mi Aplicación') }}
            </a>

            <!-- Botón para móviles -->
            <button 
              class="navbar-toggler" 
              type="button" 
              data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" 
              aria-expanded="false" 
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenido del navbar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Ejemplo de link a la home -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>

                    <!-- Si quieres mostrar secciones solo para admins, comprueba el rol -->
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    Panel Admin
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Sección derecha del navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <!-- Si no está autenticado, mostramos login y register -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @else
                        <!-- Si está autenticado, mostramos su nombre y la opción de logout -->
                        <li class="nav-item dropdown">
                            <a 
                              class="nav-link dropdown-toggle" 
                              href="#" 
                              id="navbarDropdown" 
                              role="button" 
                              data-bs-toggle="dropdown" 
                              aria-expanded="false"
                            >
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); 
                                       document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>
                                    <form 
                                      id="logout-form" 
                                      action="{{ route('logout') }}" 
                                      method="POST" 
                                      class="d-none"
                                    >
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container my-4">
        <!-- Mensajes de estado (ej. success, error) -->
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Aquí se inyectará el contenido de cada vista -->
        @yield('content')
    </div>

    <!-- Bootstrap JS (CDN) -->
    <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Opcional: tu archivo JS adicional -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
