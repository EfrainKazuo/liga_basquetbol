<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Liga de Básquetbol')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/liga.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark liga-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}"><span>Liga</span> de Básquetbol</a>

            @auth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Abrir menú">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav me-auto ms-md-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('equipos.*', 'jugadores.*') ? 'active' : '' }}"
                               href="{{ route('equipos.index') }}">Equipos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('partidos.*') ? 'active' : '' }}"
                               href="{{ route('partidos.index') }}">Partidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('posiciones') ? 'active' : '' }}"
                               href="{{ route('posiciones') }}">Posiciones</a>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center gap-3 mb-0 mt-2 mt-md-0">
                        @csrf
                        <span class="small text-secondary">{{ auth()->user()->name }}</span>
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Cerrar sesión</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="container liga-footer text-center">
        Liga de Básquetbol · Sistema de gestión
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>