@extends('layouts.masterusers')

@section('title', 'Listado de Categorías')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Categorías</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Crear Categoría
        </a>
    </div>

    @if($categories->isEmpty())
        <p>No hay categorías registradas.</p>
    @else
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th class="text-center" style="width:220px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td class="align-middle">{{ $cat->name }}</td>
                    <td class="align-middle">{{ $cat->description }}</td>
                    <td class="align-middle">
                        @if($cat->image)
                            <img 
                              src="{{ asset($cat->image) }}" 
                              alt="{{ $cat->name }}" 
                              style="width: 60px; height: 60px; object-fit: cover;"
                            >
                        @else
                            <img 
                              src="{{ asset('images/no-imagen.webp') }}" 
                              alt="Sin imagen" 
                              style="width: 60px; height: 60px; object-fit: cover;"
                            >
                        @endif
                    </td>
                    <td class="align-middle text-center">
                        <a 
                          href="{{ route('admin.categories.edit', $cat->id) }}" 
                          class="btn btn-sm btn-warning"
                        >
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form 
                          action="{{ route('admin.categories.destroy', $cat->id) }}" 
                          method="POST" 
                          class="d-inline-block"
                          onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
