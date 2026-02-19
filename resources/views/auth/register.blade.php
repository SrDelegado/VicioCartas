@extends('plantilla')

@section('titulo', 'Crear Cuenta')

@section('contenido')
<div class="row justify-content-center py-5">
    <div class="col-md-4">
        <div class="card bg-dark text-white border-info shadow-lg">
            <div class="card-body p-4">
                <h3 class="text-center mb-4 text-info fw-bold">Nuevo Jugador</h3>
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre de Usuario</label>
                        <input type="text" name="name" class="form-control bg-secondary text-white border-0" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control bg-secondary text-white border-0" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control bg-secondary text-white border-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control bg-secondary text-white border-0" required>
                    </div>
                    <button type="submit" class="btn btn-info w-100 fw-bold py-2">CREAR MI CUENTA</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection