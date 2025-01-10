<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>LuxuryParfum</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            .profile-image {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                object-fit: cover;
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-light py-4 mt-auto">
                <div class="container text-center">
                    <p class="mb-0">© {{ date('Y') }} LuxuryParfum. Todos los derechos reservados.</p>
                    <small><a href="{{ route('contacto') }}">Contacto</a> | <a href="{{ route('privacidad') }}">Política de Privacidad</a></small>
                </div>
            </footer>
        </div>
    </body>
</html>
