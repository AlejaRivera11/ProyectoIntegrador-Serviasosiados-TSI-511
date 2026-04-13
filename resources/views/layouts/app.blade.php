<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviasociados</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <div class="layout">

        {{-- SIDEBAR --}}
        <aside class="sidebar">

            {{-- Logo --}}
            <div class="sidebar-header">
                <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="sidebar-logo">
                <span class="sidebar-title">Serviasociados</span>
            </div>

            {{-- Usuario --}}
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    <img src="{{ asset('img/usuario.png') }}" alt="avatar">
                </div>
                <p>{{ auth()->user()?->rol ?? 'Usuario' }}</p>
            </div>

            {{-- Navegación --}}
            <nav class="sidebar-nav">

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

                <a href="" class="nav-item">
                    <i class="fas fa-wrench"></i> Servicios
                </a>

                <a href="" class="nav-item">
                    <i class="fas fa-user-cog"></i> Gestión de usuarios
                </a>

                {{-- Solo Administrador --}}
                @if (auth()->user()?->rol === 'administrador')
                    <a href="" class="nav-item">Reportes</a>
                    <a href="" class="nav-item">Servicios</a>
                    <a href="" class="nav-item">Gestion de Usuarios</a>
                @endif

            </nav>

            {{-- Cerrar sesión --}}
            <div class="sidebar-footer">
                <form method="POST" action="">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar Sesion</button>
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

            {{-- Contenido de cada vista --}}
            @yield('contenido')

        </main>

    </div>

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
