@extends('layouts.masterusers')
@section('title', 'Editar Usuario')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Usuario</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input 
              type="text" 
              name="name" 
              id="name"
              class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name', $user->name) }}"
              required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
              type="email" 
              name="email" 
              id="email"
              class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email', $user->email) }}"
              required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Rol --}}
        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select 
              name="role" 
              id="role" 
              class="form-select @error('role') is-invalid @enderror"
              required
            >
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password + Confirm (opcional) --}}
        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
            <input 
              type="password"
              name="password"
              id="password"
              class="form-control @error('password') is-invalid @enderror"
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Deja esto en blanco si no deseas cambiar la contraseña.</small>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
            <input 
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              class="form-control"
            >
        </div>

        <button type="submit" class="btn btn-warning">
            <i class="bi bi-save"></i> Actualizar
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">
            Cancelar
        </a>
    </form>
</div>
@endsection
