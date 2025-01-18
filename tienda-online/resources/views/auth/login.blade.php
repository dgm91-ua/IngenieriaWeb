@extends('layouts.masterusers')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Iniciar Sesión</h4>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recuérdame</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Iniciar Sesión</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
