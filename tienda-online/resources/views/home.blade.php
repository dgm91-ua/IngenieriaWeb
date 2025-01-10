@extends('layouts.masterusers')


@section('content')
<div class="container-fluid p-0">

    <!-- Slider / Carousel -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 70vh;">
                <img src="{{ asset('images/carroussel/1.webp') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block text-start">
                    <h1 class="fw-bold">LuxuryParfum</h1>
                    <p class="lead">Las fragancias más exclusivas te esperan</p>
                    <a href="{{ url('/productos') }}" class="btn btn-primary btn-lg">Ver Catálogo</a>
                </div>
            </div>
            <div class="carousel-item" style="height: 70vh;">
                <img src="{{ asset('images/carroussel/2.webp') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block text-start">
                    <h1 class="fw-bold">Aromas Inolvidables</h1>
                    <p class="lead">Encuentra perfumes para cada ocasión</p>
                    <a href="{{ route('categorias.random') }}" class="btn btn-warning btn-lg">
                        Descubrir Ahora
                    </a>
                </div>
            </div>

            <div class="carousel-item" style="height: 70vh;">
                <img src="{{ asset('images/carroussel/3.webp') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block text-start">
                    <h1 class="fw-bold">Fragancias Premium</h1>
                    <p class="lead">Calidad, sofisticación y estilo</p>
                    <a href="{{ url('/categorias') }}" class="btn btn-light btn-lg">Explorar</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<div class="container my-5">

    <!-- Barra de Búsqueda -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="{{ url('/buscar') }}" method="GET" class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar perfumes, marcas..." name="q" aria-label="Buscar">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Sección de Destacados/Categorías -->
    <h2 class="mb-4 text-center">Categorías Destacadas</h2>
    <div class="row g-4">
        @foreach($randomCategories as $category)
        <div class="col-md-3">
            <div class="card h-100 shadow">
                <img 
                    src="{{ $category->image ? asset($category->image) : asset('images/no-imagen.webp') }}" 
                    class="card-img-top" 
                    alt="{{ $category->name }}"
                >
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ Str::limit($category->description, 80) }}</p>
                    <a href="{{ url('/productos/'.$category->id) }}" class="btn btn-sm btn-outline-primary">Ver más</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Sección sobre la tienda -->
    <div class="my-5 text-center">
        <h2>Sobre LuxuryParfum</h2>
        <p class="lead">En LuxuryParfum creemos en la distinción y elegancia de las mejores fragancias. Nuestro amplio catálogo ofrece experiencias olfativas inolvidables. La calidad, el lujo y la excelencia nos posicionan como una referencia en el mundo de la perfumería.</p>
        <a href="{{ route('nosotros') }}" class="btn btn-link">Más sobre nosotros</a>
    </div>
</div>

@endsection
