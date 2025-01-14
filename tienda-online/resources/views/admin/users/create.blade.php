@extends('layouts.masterusers')

@section('title', 'Crear Usuario')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear nuevo Usuario</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input 
              type="text" 
              name="name" 
              id="name"
              class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') }}"
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
              value="{{ old('email') }}"
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
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password + Confirm --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input 
              type="password" 
              name="password" 
              id="password"
              class="form-control @error('password') is-invalid @enderror"
              required
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input 
              type="password" 
              name="password_confirmation" 
              id="password_confirmation"
              class="form-control"
              required
            >
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Guardar
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">
            Cancelar
        </a>
    </form>
</div>
@endsection
