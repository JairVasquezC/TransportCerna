<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-red" id="sidenavAccordion">
        <div class="sb-sidenav-menu text-white">
            <div class="nav">

                <div class="sb-sidenav-menu-heading">Inicio</div>
                <a class="nav-link text-white" href="{{ route('panel') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading text-white">Modulos</div>
                @can('ver-cliente')
                <a class="nav-link text-white" href="{{ route('clientes.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Clientes
                </a>
                @endcan

                @can('ver-proveedore')
                <a class="nav-link text-white" href="{{ route('proveedores.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>
                    Vehículos
                </a>
                @endcan

                @can('ver-marca')
                <a class="nav-link text-white" href="{{ route('marcas.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bullhorn"></i></div>
                    Viajes
                </a>
                @endcan

                <!----Compras---->
                @can('ver-compra')
                <a class="nav-link collapsed text-white" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                    Gestión
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav text-white">
                        @can('ver-compra')
                        <a class="nav-link text-white" href="{{ route('compras.index') }}">Encomiendas</a>
                        @endcan
                        @can('ver-venta')
                        <a class="nav-link text-white" href="{{ route('ventas.index') }}">Pasajes</a>
                        @endcan
                    </nav>
                </div>
                @endcan

                {{-- @can('ver-categoria')
                <a class="nav-link text-white" href="{{ route('categorias.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                    Categorías
                </a>
                @endcan

                @can('ver-presentacione')
                <a class="nav-link text-white" href="{{ route('presentaciones.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-box-archive"></i></div>
                    Presentaciones
                </a>
                @endcan



                @can('ver-producto')
                <a class="nav-link text-white" href="{{ route('productos.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-shopify"></i></div>
                    Productos
                </a>
                @endcan --}}

                @hasrole('administrador')
                <div class="sb-sidenav-menu-heading">OTROS</div>
                @endhasrole

                @can('ver-user')
                <a class="nav-link text-white" href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Usuarios
                </a>
                @endcan

                @can('ver-role')
                <a class="nav-link text-white" href="{{ route('roles.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-person-circle-plus"></i></div>
                    Roles
                </a>
                @endcan


            </div>
        </div>
        {{-- <div class="sb-sidenav-footer">
            <div class="small">Bienvenido:</div>
            {{ auth()->user()->name }}
        </div> --}}
    </nav>
</div>