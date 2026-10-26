<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Liga de Básquetbol')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">🏀 Liga de Básquetbol</a>
            @auth
                <a class="nav-link text-white me-auto ms-3" href="{{ route('equipos.index') }}">Equipos</a>
            @endauth
            @auth
                <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center gap-3 mb-0">
                    @csrf
                    <span class="text-white">{{ auth()->user()->name }}</span>
                    <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                </form>
            @endauth
            @auth
    <a class="nav-link text-white ms-3" href="{{ route('equipos.index') }}">Equipos</a>
    <a class="nav-link text-white me-auto ms-3" href="{{ route('partidos.index') }}">Partidos</a>
@endauth
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>