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
        .alert { position: fixed; top: 20px; right: 20px; z-index: 1000; min-width: 300px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('inicio') }}">🃏 CardMaster</a>
            <div class="navbar-nav ms-auto align-items-center">
                @auth
                    <span class="nav-link text-warning fw-bold fs-5 me-3" id="saldo-display">
                        💰 {{ Auth::user()->wallet }}€
                    </span>
                    <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger ms-2">Salir</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-warning fw-bold">Entrar / Registro</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                <strong>¡Genial!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                <strong>¡Vaya!</strong> {{ session('error') ?? 'Revisa los datos del formulario.' }}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('contenido')
    </div>
</body>
</html>