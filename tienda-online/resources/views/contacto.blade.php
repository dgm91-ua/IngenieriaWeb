@extends('layouts.masterusers')

@section('content')
<div class="container my-5">
    <h1>Contacto</h1>
    <p>¿Tienes alguna pregunta, comentario o sugerencia? ¡Estamos encantados de ayudarte!</p>
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" id="correo" name="correo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Enviar</button>
    </form>
</div>
@endsection
