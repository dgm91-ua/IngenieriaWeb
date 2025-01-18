@extends('layouts.masterusers')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Mi Perfil</h4>
                
                <!-- Información del usuario -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre:</label>
                    <p class="form-control bg-light">{{ auth()->user()->name }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Correo Electrónico:</label>
                    <p class="form-control bg-light">{{ auth()->user()->email }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Dirección:</label>
                    <p class="form-control bg-light">{{ auth()->user()->address }}</p>
                </div>

                <!-- Opciones -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="btn btn-outline-secondary" href="{{ url('/') }}">Volver al inicio</a>
                    <a class="btn btn-custom" href="{{ route('profile.edit') }}">Editar Perfil</a>

                    <!-- Botón para eliminar perfil -->
                    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu perfil? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Perfil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
