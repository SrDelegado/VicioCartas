@extends('plantilla')

@section('contenido')
<div class="row justify-content-center py-5">
    <div class="col-md-4">
        <div class="card bg-dark text-white border-warning shadow-lg">
            <div class="card-body p-4">
                <h3 class="text-center mb-4 text-warning fw-bold">Entrar al Juego</h3>
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="name" class="form-control bg-secondary text-white border-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control bg-secondary text-white border-0" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold">ENTRAR</button>
                </form>
                <hr class="border-secondary my-4">
                <div class="text-center">
                    <p class="small text-secondary mb-2 text-white">¿Eres nuevo?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-info btn-sm w-100 fw-bold">CREAR CUENTA NUEVA</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection