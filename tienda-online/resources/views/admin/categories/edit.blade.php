@extends('layouts.masterusers')

@section('title', 'Editar Categoría')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Categoría</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form 
      action="{{ route('admin.categories.update', $category->id) }}" 
      method="POST" 
      enctype="multipart/form-data"
    >
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
                value="{{ old('name', $category->name) }}"
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
            >{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Imagen (opcional) --}}
        <div class="mb-3">
            <label for="image" class="form-label">Imagen representativa</label>
            <div class="mb-2">
                @if($category->image)
                    <img 
                      src="{{ asset($category->image) }}" 
                      alt="{{ $category->name }}"
                      style="width:100px; height:100px; object-fit:cover;"
                    >
                @else
                    <img 
                      src="{{ asset('images/no-imagen.webp') }}" 
                      alt="Sin imagen"
                      style="width:100px; height:100px; object-fit:cover;"
                    >
                @endif
            </div>
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

        <button type="submit" class="btn btn-warning">
            <i class="bi bi-save"></i> Actualizar
        </button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">
            Cancelar
        </a>
    </form>
</div>
@endsection
