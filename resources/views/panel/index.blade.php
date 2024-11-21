@extends('layouts.app')

@section('title', 'Panel')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

@if (session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let message = "{{ session('success') }}";
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: message,
            timer: 3000,
            showConfirmButton: false
        });
    });
</script>
@endif

<div class="container-fluid px-4">
    <h3 class="mt-4 text-center text-danger">Dashboard</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    
    <!-- Tarjetas -->
    <div class="row">
        @php
        use App\Models\Cliente;
        use App\Models\Categoria;
        use App\Models\Compra;
        use App\Models\Marca;
        use App\Models\Presentacione;
        use App\Models\Producto;
        use App\Models\Proveedore;
        use App\Models\User;

        $stats = [
            ['title' => 'Clientes', 'count' => Cliente::count(), 'color' => 'bg-primary', 'icon' => 'fa-people-group', 'route' => 'clientes.index'],
            ['title' => 'Encomiendas', 'count' => Categoria::count(), 'color' => 'bg-warning', 'icon' => 'fa-tag', 'route' => 'categorias.index'],
            ['title' => 'Pasajes', 'count' => Compra::count(), 'color' => 'bg-success', 'icon' => 'fa-store', 'route' => 'ventas.index'],
            ['title' => 'Viajes', 'count' => Marca::count(), 'color' => 'bg-danger', 'icon' => 'fa-bullhorn', 'route' => 'marcas.index'],
            ['title' => 'Vehículos', 'count' => Proveedore::count(), 'color' => 'bg-warning', 'icon' => 'fa-user-group', 'route' => 'proveedores.index'],
            ['title' => 'Usuarios', 'count' => User::count(), 'color' => 'bg-primary', 'icon' => 'fa-user', 'route' => 'users.index']
        ];
        @endphp

        @foreach ($stats as $stat)
        <div class="col-xl-3 col-md-6">
            <div class="card {{ $stat['color'] }} text-white mb-4 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid {{ $stat['icon'] }}"></i><span class="m-1">{{ $stat['title'] }}</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{ $stat['count'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route($stat['route']) }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Gráfico de ventas semanales -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-chart-line me-1"></i>
                    Ventas Semanales
                </div>
                <div class="card-body">
                    <canvas id="salesChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos del gráfico de ventas
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [{
                    label: 'Ventas ($)',
                    data: [120, 200, 150, 300, 250, 400, 320],
                    backgroundColor: 'rgba(200, 35, 51, 0.2)',
                    borderColor: 'rgba(200, 35, 51, 1)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
