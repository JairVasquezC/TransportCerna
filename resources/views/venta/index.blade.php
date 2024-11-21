@extends('layouts.app')

@section('title','pasajes')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .row-not-space {
        width: 110px;
    }
</style>
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h3 class="mt-4 text-center text-black">Pasajes</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Pasajes</li>
    </ol>

    @can('crear-venta')
    <div class="mb-4">
        <a href="{{route('ventas.create')}}">
            <button type="button" class="btn btn-danger">Nuevo registro</button>
        </a>
    </div>
    @endcan

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Pasajes
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Viaje</th>
                        <th>Cliente</th>
                        <th>Costo</th>
                        <th>Fecha Venta</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>V-0012</td>
                        <td>Juan Quiroz</td>
                        <td>S/. 20.00</td>
                        <td>20/10/2025</td>
                        <td>
                            <!-- Desplegable para ver el estado -->
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="badge bg-secondary estado-text">Pendiente</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'Pendiente')"><span class="badge bg-secondary">Pendiente</span></a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'En Proceso')"><span class="badge bg-info">En Proceso</span></a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'Completado')"><span class="badge bg-success">Completado</span></a></li>
                                </ul>
                            </div>
                        </td>
                    
                        <!-- Modal de Confirmación -->
                        <div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalConfirmacionLabel">Confirmación de cambio de estado</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas cambiar el estado a "<span id="nuevo-estado"></span>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="btn-confirmar" onclick="cambiarEstado()">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <td>
                            <div class="d-flex justify-content-around">
                                <div>
                                    <button title="Opciones" class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                        @can('editar-proveedore')
                                        <li><a class="dropdown-item" href="">Editar</a></li>
                                        @endcan
                                    </ul>
                                </div>
                                <div>
                                    <div class="vr"></div>
                                </div>
                                <div>
                                    @can('eliminar-proveedore')
                                    <button title="Eliminar" data-bs-toggle="modal" data-bs-target="" class="btn btn-datatable btn-icon btn-transparent-dark">
                                        <svg class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"></path>
                                        </svg>
                                    </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>V-0014</td>
                        <td>Juan Quiroz</td>
                        <td>S/. 20.00</td>
                        <td>15/11/2015</td>
                        <td>
                            <!-- Desplegable para ver el estado -->
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="badge bg-secondary estado-text">Pendiente</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'Pendiente')"><span class="badge bg-secondary">Pendiente</span></a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'En Proceso')"><span class="badge bg-info">En Proceso</span></a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'Completado')"><span class="badge bg-success">Completado</span></a></li>
                                </ul>
                            </div>
                        </td>
                    
                        <!-- Modal de Confirmación -->
                        <div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalConfirmacionLabel">Confirmación de cambio de estado</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas cambiar el estado a "<span id="nuevo-estado"></span>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="btn-confirmar" onclick="cambiarEstado()">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <td>
                            <div class="d-flex justify-content-around">
                                <div>
                                    <button title="Opciones" class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                        @can('editar-proveedore')
                                        <li><a class="dropdown-item" href="">Editar</a></li>
                                        @endcan
                                    </ul>
                                </div>
                                <div>
                                    <div class="vr"></div>
                                </div>
                                <div>
                                    @can('eliminar-proveedore')
                                    <button title="Eliminar" data-bs-toggle="modal" data-bs-target="" class="btn btn-datatable btn-icon btn-transparent-dark">
                                        <svg class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"></path>
                                        </svg>
                                    </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>V-0016</td>
                        <td>Juan Quiroz</td>
                        <td>S/. 20.00</td>
                        <td>05/05/2024</td>
                        <td>
                            <!-- Desplegable para ver el estado -->
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="badge bg-secondary estado-text">Pendiente</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'Pendiente')"><span class="badge bg-secondary">Pendiente</span></a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'En Proceso')"><span class="badge bg-info">En Proceso</span></a></li>
                                    <li><a class="dropdown-item" href="#" onclick="confirmarCambio(this, 'Completado')"><span class="badge bg-success">Completado</span></a></li>
                                </ul>
                            </div>
                        </td>
                    
                        <!-- Modal de Confirmación -->
                        <div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalConfirmacionLabel">Confirmación de cambio de estado</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas cambiar el estado a "<span id="nuevo-estado"></span>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="btn-confirmar" onclick="cambiarEstado()">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <td>
                            <div class="d-flex justify-content-around">
                                <div>
                                    <button title="Opciones" class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                        @can('editar-proveedore')
                                        <li><a class="dropdown-item" href="">Editar</a></li>
                                        @endcan
                                    </ul>
                                </div>
                                <div>
                                    <div class="vr"></div>
                                </div>
                                <div>
                                    @can('eliminar-proveedore')
                                    <button title="Eliminar" data-bs-toggle="modal" data-bs-target="" class="btn btn-datatable btn-icon btn-transparent-dark">
                                        <svg class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"></path>
                                        </svg>
                                    </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    @foreach ($ventas as $item)
                    <tr>
                        <td>
                            <p class="fw-semibold mb-1">{{$item->comprobante->tipo_comprobante}}</p>
                            <p class="text-muted mb-0">{{$item->numero_comprobante}}</p>
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">{{ ucfirst($item->cliente->persona->tipo_persona) }}</p>
                            <p class="text-muted mb-0">{{$item->cliente->persona->razon_social}}</p>
                        </td>
                        <td>
                            <div class="row-not-space">
                                <p class="fw-semibold mb-1"><span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>{{\Carbon\Carbon::parse($item->fecha_hora)->format('d-m-Y')}}</p>
                                <p class="fw-semibold mb-0"><span class="m-1"><i class="fa-solid fa-clock"></i></span>{{\Carbon\Carbon::parse($item->fecha_hora)->format('H:i')}}</p>
                            </div>
                        </td>
                        <td>
                            {{$item->user->name}}
                        </td>
                        <td>
                            {{$item->total}}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                @can('mostrar-venta')
                                <form action="{{route('ventas.show', ['venta'=>$item]) }}" method="get">
                                    <button type="submit" class="btn btn-success">
                                        Ver
                                    </button>
                                </form>
                                @endcan

                                @can('eliminar-venta')
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Eliminar</button>
                                @endcan
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de confirmación-->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que quieres eliminar el registro?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('ventas.destroy',['venta'=>$item->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script>
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki
    window.addEventListener('DOMContentLoaded', event => {
        const dataTable = new simpleDatatables.DataTable("#datatablesSimple", {})
    });
</script>
<script>
    // Función que muestra la modal de confirmación con el nuevo estado
    let nuevoEstado = "";
    let nuevoColor = "";  // Para almacenar el color de la clase
    let botonEstado = null; // Para almacenar el botón que se va a actualizar

    function confirmarCambio(elemento, estado) {
        nuevoEstado = estado;  // Guardar el estado seleccionado
        botonEstado = elemento.closest('.dropdown').querySelector('.estado-text'); // Encontrar el estado del botón correspondiente

        // Asignar el color correspondiente al estado
        switch (estado) {
            case "Pendiente":
                nuevoColor = "bg-secondary";
                break;
            case "En Proceso":
                nuevoColor = "bg-info";
                break;
            case "Completado":
                nuevoColor = "bg-success";
                break;
            default:
                nuevoColor = "bg-secondary";
        }

        // Mostrar el texto y el color en la modal
        document.getElementById("nuevo-estado").textContent = nuevoEstado;
        // Mostrar la modal
        new bootstrap.Modal(document.getElementById('modalConfirmacion')).show();
    }

    // Función que realiza el cambio de estado y actualiza el texto y color
    function cambiarEstado() {
        // Cambiar el texto y el color del estado en el botón correspondiente
        botonEstado.textContent = nuevoEstado;
        botonEstado.className = "badge " + nuevoColor;

        // Cerrar la modal
        let modal = bootstrap.Modal.getInstance(document.getElementById('modalConfirmacion'));
        modal.hide();
    }
</script>


@endpush