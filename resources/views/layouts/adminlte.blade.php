<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Power Trade') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/PowerTradeLogo.png') }}">

    <!-- Scripts -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://kit.fontawesome.com/460dd6b0eb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Latest compiled and minified CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{-- $(function () {
        $('select').selectpicker();
    }); --}}
</head>
<body>
    <div id="app">
        <!-- Preloader -->
        {{-- <div class="preloader">
            <img src="{{ asset ('img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div> --}}

        <!-- Navbar -->
        <top-menu>
            <template v-slot:menu-right>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <div class="info">
                            <img src="{{ asset ('img/PowerTradeLogo.png') }}" class="img-circle elevation-2" alt="Usuario" style="width: 2.0rem; margin-right: 8px;">
                            {{ Auth::user()->name }}
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user-cog"></i> Mi Perfil
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{-- {{ __('Logout') }} --}}
                            <i class="fas fa-sign-out-alt"></i> Salir
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{-- <a href="#" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Salir
                        </a> --}}
                    </div>
                </li>
            </template>
        </top-menu>
        <aside-menu logo="{{ asset ('img/logo2.png') }}" empresa="Power Trade" avatar="{{ asset ('img/PowerTradeLogo.png') }}" usuario="{{ Auth::user()->name }}" linkuser="#">
            <li class="nav-item">
                <a href="{{ route('adminicio') }}" class="nav-link {{ (Route::currentRouteName() == 'adminicio') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-house-user"></i>
                    <p>
                        Inicio
                    </p>
                </a>
            </li>
            @can('eLog')
                <li class="nav-item {{ ((request()->segment(2) == 'clientes') || (request()->segment(2) == 'freteiros') || (request()->segment(2) == 'despachantes')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->segment(2) == 'clientes') || (request()->segment(2) == 'freteiros') || (request()->segment(2) == 'despachantes') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Catastros
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('clientes.index') }}" class="nav-link {{ (request()->segment(2) == 'clientes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('freteiros.index') }}" class="nav-link {{ (request()->segment(2) == 'freteiros') ? 'active' : '' }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fleteros</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('despachantes.index') }}" class="nav-link {{ (request()->segment(2) == 'despachantes') ? 'active' : '' }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Despachante</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ((request()->segment(2) == 'cargas') || (request()->segment(2) == 'warehouses') || (request()->segment(2) == 'paquetes')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->segment(2) == 'cargas') || (request()->segment(2) == 'warehouses') || (request()->segment(2) == 'paquetes') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Logistica
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cargas.index') }}" class="nav-link {{ (request()->segment(2) == 'cargas') ? 'active' : '' }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cargas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('warehouses.index') }}" class="nav-link {{ (request()->segment(2) == 'warehouses') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warehouses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paquetes.index') }}" class="nav-link {{ (request()->segment(2) == 'paquetes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paquetes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Relatórios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cargas</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warehouses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paquetes</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
            @endcan

            @can('eCli')
                <li class="nav-item">
                    <a href="{{ route('dados.index') }}" class="nav-link {{ (request()->segment(2) == 'dados') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                            Mis Datos
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ ((request()->segment(2) == 'cargas') || (request()->segment(2) == 'warehouses') || (request()->segment(2) == 'paquetes')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->segment(2) == 'cargas') || (request()->segment(2) == 'warehouses') || (request()->segment(2) == 'paquetes') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Mis Paquetes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>En Miami</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('warehouses.index') }}" class="nav-link {{ (request()->segment(2) == 'warehouses') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Disponibles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paquetes.index') }}" class="nav-link {{ (request()->segment(2) == 'paquetes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Historial</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ((request()->segment(2) == 'cargas') || (request()->segment(2) == 'warehouses') || (request()->segment(2) == 'paquetes')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->segment(2) == 'cargas') || (request()->segment(2) == 'warehouses') || (request()->segment(2) == 'paquetes') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Mis Pagos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendentes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paquetes.index') }}" class="nav-link {{ (request()->segment(2) == 'paquetes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Historial</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- <li class="nav-item">
                <a href="{{ route('inicio') }}" class="nav-link {{ (Route::currentRouteName() == 'inicio') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-house-user"></i>
                    <p>
                        Inicio
                    </p>
                </a>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'categorias.index' || Route::currentRouteName() == 'marcas' || Route::currentRouteName() == 'productos') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (Route::currentRouteName() == 'categorias.index' || Route::currentRouteName() == 'marcas' || Route::currentRouteName() == 'productos') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Catastros
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('categorias.index') }}" class="nav-link {{ (Route::currentRouteName() == 'categorias.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Categorias</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ (Route::currentRouteName() == 'marcas') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marcas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ (Route::currentRouteName() == 'productos') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Productos</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p>
                        Site
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Banners</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Historia</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sucursales</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Starter Pages
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactive Page</p>
                    </a>
                </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="right badge badge-danger">New</span>
                </p>
                </a>
            </li> --}}
        </aside-menu>
        <main class="content-wrapper">
            @yield('content')
        </main>
    </div>
</body>
</html>
