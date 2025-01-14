@extends('layouts.masterusers')

@section('title', 'Listado de Usuarios')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Crear Usuario
        </a>
    </div>

    @if($users->isEmpty())
        <p>No hay usuarios registrados.</p>
    @else
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Creado</th>
                    <th class="text-center" style="width: 220px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $u)
                <tr>
                    <td class="align-middle">{{ $u->name }}</td>
                    <td class="align-middle">{{ $u->email }}</td>
                    <td class="align-middle">{{ $u->role }}</td>
                    <td class="align-middle">{{ $u->created_at->format('d/m/Y') }}</td>
                    <td class="align-middle text-center">
                        <a 
                          href="{{ route('admin.users.edit', $u->id) }}" 
                          class="btn btn-sm btn-warning"
                        >
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form 
                          action="{{ route('admin.users.destroy', $u->id) }}" 
                          method="POST" 
                          class="d-inline-block"
                          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');"
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
