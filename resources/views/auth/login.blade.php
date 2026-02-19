@extends('plantilla')

@section('titulo', 'Iniciar Sesión')

@section('contenido')
<div class="row justify-content-center py-5">
    <div class="col-md-4">
        <div class="card bg-dark text-white border-warning shadow-lg">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-warning">¡Bienvenido!</h2>
                    <p class="text-secondary">Accede a tu colección de cartas</p>
                </div>

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre de Usuario</label>
                        <input type="text" name="name" class="form-control bg-secondary text-white border-0" placeholder="Ej: admin" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control bg-secondary text-white border-0" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold py-2">ENTRAR AL JUEGO</button>
                </form>

                <div class="text-center mt-4">
                    <small class="text-secondary">Si entras como <b>admin</b> obtendrás 10.000€</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection