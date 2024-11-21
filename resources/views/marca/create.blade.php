@extends('layouts.app')

@section('title','Crear viajes')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Viaje</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('marcas.index')}}">Viajes</a></li>
        <li class="breadcrumb-item active">Crear Viaje</li>
    </ol>

    <div class="card">
        <form action="{{ route('marcas.store') }}" method="post">
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-4">

                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                        @error('fecha')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="hora" class="form-label">Hora:</label>
                        <input type="time" name="hora" id="hora" class="form-control">
                        @error('hora')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="chofer" class="form-label">Chofer:</label>
                        <select name="chofer" id="chofer" class="form-select">
                            <option value="" selected disabled>Seleccione un chofer</option>
                            <option value="chofer1">Juan Perez</option>
                            <!-- Agrega más opciones si es necesario -->
                        </select>
                        @error('chofer')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vehiculo" class="form-label">Vehículo:</label>
                        <select name="vehiculo" id="vehiculo" class="form-select">
                            <option value="" selected disabled>Seleccione un vehículo</option>
                            <option value="vehiculo1">AB-123</option>
                            <!-- Agrega más opciones si es necesario -->
                        </select>
                        @error('vehiculo')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-danger">Guardar</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush