<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviasociados</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfilCliente.css') }}">
</head>

<body>

    {{-- Botón hamburguesa --}}
    <button class="menu-toggle" id="menu-toggle">☰</button>
    <div class="overlay" id="overlay"></div>

    <div class="layout">

        {{-- SIDEBAR --}}
        <aside class="sidebar" id="sidebar">

            {{-- Logo --}}
            <div class="sidebar-header">
                <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="sidebar-logo">
                <span class="sidebar-title">Serviasociados</span>
            </div>

            {{-- Usuario --}}
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    <img src="{{ asset('img/usuario3.png') }}" alt="avatar">
                </div>
                <p>
                    {{ auth()->user()?->cliente?->nombre_cliente ??
                        (ucfirst(auth()->user()?->getRoleNames()->first()) ?? 'Usuario') }}
                </p>

            </div>

            {{-- Navegación según rol --}}
            <nav class="sidebar-nav">

                @if (auth()->user()?->hasRole('cliente'))
                    <a href="{{ route('inicio') }}" class="nav-item {{ request()->routeIs('inicio') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <a href="{{ route('perfilCliente.datosPersonales') }}"
                        class="nav-item {{ request()->routeIs('perfilCliente') ? 'active' : '' }}">
                        <i class="fas fa-user"></i> Datos Personales
                    </a>
                    <a href="{{ route('perfilCliente.misVehiculos') }}"
                        class="nav-item {{ request()->routeIs('perfilCliente.misVehiculos') ? 'active' : '' }}">
                        <i class="fas fa-car"></i> Mis Vehiculos
                    </a>
                    <a href="" class="nav-item">
                        <i class="fas fa-calendar-plus"></i> Agendar Cita
                    </a>
                    <a href="" class="nav-item">
                        <i class="fas fa-calendar-check"></i> Mis Citas
                    </a>
                @elseif(auth()->user()?->hasRole('recepcionista'))
                    <a href="{{ route('inicio') }}"
                        class="nav-item {{ request()->routeIs('inicio') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>

                    <a href="{{ route('cliente.index') }}"
                        class="nav-item {{ request()->routeIs('cliente.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Clientes
                    </a>
                    <a href="{{ route('vehiculo.index') }}"
                        class="nav-item {{ request()->routeIs('vehiculo.*') ? 'active' : '' }}">
                        <i class="fas fa-car"></i> Vehículos
                    </a>
                    <a href="" class="nav-item">
                        <i class="fas fa-calendar-plus"></i> Agendar Cita
                    </a>
                    <a href="" class="nav-item">
                        <i class="fas fa-calendar-check"></i> Citas Programadas
                    </a>
                @elseif(auth()->user()?->hasRole('administrador'))
                    <a href="{{ route('inicio') }}"
                        class="nav-item {{ request()->routeIs('inicio') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>

                    <a href="{{ route('cliente.index') }}"
                        class="nav-item {{ request()->routeIs('cliente.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Clientes
                    </a>
                    <a href="{{ route('vehiculo.index') }}"
                        class="nav-item {{ request()->routeIs('vehiculo.*') ? 'active' : '' }}">
                        <i class="fas fa-car"></i> Vehículos
                    </a>
                    <a href="" class="nav-item">
                        <i class="fas fa-calendar-plus"></i> Agendar Cita
                    </a>
                    <a href="" class="nav-item">
                        <i class="fas fa-calendar-check"></i> Citas Programadas
                    </a>
                    <a href="" class="nav-item">
                        <i class="fas fa-chart-line"></i> Reportes
                    </a>
                    <a href="{{ route('servicio.index') }}"
                        class="nav-item {{ request()->routeIs('servicio.*') ? 'active' : '' }}">
                        <i class="fas fa-wrench"></i> Servicios
                    </a>
                    <a href="{{ route('mecanico.index') }}"
                        class="nav-item {{ request()->routeIs('mecanico.*') ? 'active' : '' }}">
                        <i class="fas fa-solid fa-users-gear"></i> Mecanicos
                    </a>
                    <a href="{{ route('usuario.index') }}"
                        class="nav-item {{ request()->routeIs('usuario.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-shield"></i> Gestión de Usuarios
                    </a>
                @endif

            </nav>

            {{-- Cerrar sesión --}}
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                    </button>
                </form>
            </div>

        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="main">
            <header class="main-header">
                <h1 class="page-title">@yield('titulomain')</h1>
            </header>

            {{-- Mensajes de éxito --}}
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('contenido')

        </main>

    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')

</body>

</html>
