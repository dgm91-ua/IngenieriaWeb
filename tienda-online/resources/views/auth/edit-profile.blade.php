@extends('layouts.masterusers')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Editar Perfil</h4>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', auth()->user()->address) }}" required>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                        <input type="password" id="password" name="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a class="text-decoration-none text-muted" href="{{ route('profile.show') }}">Cancelar</a>
                        <button type="submit" class="btn btn-custom">Actualizar Perfil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
