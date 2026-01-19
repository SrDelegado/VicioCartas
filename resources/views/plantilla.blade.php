<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo') - CardMaster</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">CardMaster</a>
            <span class="navbar-text text-warning">
                Dinero: 100€ </span>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('contenido')
    </div>
</body>
</html>