@extends('layouts.masterusers')

@section('title', 'Panel de Administración')

@section('content')
<div class="container">
    <h1>Bienvenido al Panel de Administración</h1>
    <div class="mt-4">
        <p>Desde aquí puedes gestionar los productos y usuarios.</p>

        <!-- Botones de acceso a los CRUD -->
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary me-2">
            <i class="bi bi-box-seam"></i> Gestionar Productos
        </a>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary me-2">
            <i class="bi bi-box-seam"></i> Gestionar Categorias
        </a>

        <a href="{{ route('admin.users.index') }}" class="btn btn-primary me-2">
            <i class="bi bi-box-seam"></i> Gestionar Usuarios
        </a>
    </div>
</div>
@endsection
