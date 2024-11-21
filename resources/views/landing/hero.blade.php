@extends('layouts.app')

@section('content')
<!-- Sección de video -->
<section class="position-relative w-100 min-vh-100 d-flex justify-content-center align-items-center">
    <!-- Video de fondo -->
    <video class="position-absolute top-0 left-0 w-100 h-100 object-cover" autoplay loop muted>
        <source src="{{ asset('assets/video6.mp4') }}" type="video/mp4">
    </video>
  
    <!-- Contenedor de contenido -->
    <div class="position-relative z-10 text-center text-white p-5">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 mt-5">
                <h6 class="display-4 font-weight-bold">Tu viaje y tus envíos, en un solo lugar</h6>
                <p class="lead mb-4">Facilitamos tus viajes y envíos con rapidez, seguridad y comodidad. ¡Todo lo que necesitas, a un clic de distancia!</p>
                <a href="#" class="btn btn-danger btn-lg rounded-pill">Ver Más</a>
            </div>
        </div>
    </div>
</section>

<!-- Sección de estadísticas -->
<section class="container py-5">
    <div class="text-center mb-4">
        <div class="w-25 h-2 mx-auto bg-danger"></div>
        <h2 class="display-4 text-danger py-4">Nuestra Experiencia</h2>
    </div>

    <div class="row text-center">
        <div class="col-md-3">
            <div class="p-4 bg-danger text-white rounded">
                <h3>10+</h3>
                <p>Años de experiencia</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-danger text-white rounded">
                <h3>15</h3>
                <p>Vehículos propios</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-danger text-white rounded">
                <h3>350+</h3>
                <p>Clientes satisfechos</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-danger text-white rounded">
                <h3>10</h3>
                <p>Personal</p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de servicios -->
<section class="bg-light py-5">
    <div class="text-center mb-4">
        <div class="w-25 h-2 mx-auto bg-danger"></div>
        <h2 class="display-4 text-danger py-4">Nuestros Servicios</h2>
    </div>

    <div class="row text-center">
        <div class="col-md-3">
            <button class="btn btn-danger w-100 rounded">
                <i class="bi bi-gear"></i>
                <p>Experiencia Comprobada</p>
            </button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-danger w-100 rounded">
                <i class="bi bi-car"></i>
                <p>Flota Propia</p>
            </button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-danger w-100 rounded">
                <i class="bi bi-person"></i>
                <p>Clientes Satisfechos</p>
            </button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-danger w-100 rounded">
                <i class="bi bi-laptop"></i>
                <p>Innovación Tecnológica</p>
            </button>
        </div>
    </div>
</section>

<!-- Sección de Video y Texto -->
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <video class="w-100" controls autoplay loop muted>
                <source src="{{ asset('assets/Cerna.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="col-md-6">
            <h2 class="display-4 text-danger">Título 01</h2>
            <p class="lead">No hay nadie que ame el dolor mismo, que lo busque, lo encuentre y lo quiera, simplemente porque es el dolor.</p>
        </div>
    </div>
</section>
@endsection
