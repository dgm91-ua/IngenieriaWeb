@extends('layouts.masterusers')

@section('title', 'Crear Categoría')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear nueva Categoría</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
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

        {{-- Descripción --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea 
                name="description" 
                id="description" 
                rows="3"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Imagen (opcional) --}}
        <div class="mb-3">
            <label for="image" class="form-label">Imagen representativa (opcional)</label>
            <input 
              type="file"
              name="image"
              id="image"
              accept="image/*"
              class="form-control @error('image') is-invalid @enderror"
            >
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Guardar
        </button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">
            Cancelar
        </a>
    </form>
</div>
@endsection
