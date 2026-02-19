<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CardMaster - @yield('titulo')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body { background-color: #1a1a2e; color: #ffffff; min-height: 100vh; }
        .navbar { background-color: #0f3460 !important; }
        .grayscale { filter: grayscale(100%); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('inicio') }}">🃏 CardMaster</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('tienda.index') }}">Tienda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('album.index') }}">Mi Álbum</a></li>
                </ul>
                <div class="navbar-nav ms-auto align-items-center">
                    @auth
                        <span class="nav-link text-warning fw-bold fs-5 me-3" id="saldo-display">
                            💰 {{ Auth::user()->wallet }}€
                        </span>
                        <span class="text-light me-2">Hola, <strong>{{ Auth::user()->name }}</strong></span>
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger ms-2">Salir</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-warning fw-bold">Entrar / Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('contenido')
    </div>

    <footer class="text-center py-4 mt-5 text-secondary">
        <small>&copy; 2026 CardMaster Game</small>
    </footer>
</body>
</html>
