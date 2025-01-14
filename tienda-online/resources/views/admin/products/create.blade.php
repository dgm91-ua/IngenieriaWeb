@extends('layouts.masterusers')

@section('title', 'Crear Producto')

@section('content')
<div class="container">
    <h1 class="mb-3">Crear nuevo Producto</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- Categoría --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select 
                name="category_id" 
                id="category_id" 
                class="form-select @error('category_id') is-invalid @enderror"
                required
            >
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categories as $category)
                    <option 
                        value="{{ $category->id }}" 
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

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

        {{-- Precio --}}
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input 
                type="number" 
                step="0.01" 
                name="price" 
                id="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price') }}"
                required
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Stock --}}
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input 
                type="number" 
                name="stock" 
                id="stock"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', 0) }}"
                required
            >
            @error('stock')
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

        <div class="mb-3">
        <label for="image" class="form-label">Imagen del producto</label>
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

        {{-- Botones --}}
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Guardar
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-2">
            Cancelar
        </a>
    </form>
</div>
@endsection
