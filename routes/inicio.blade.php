@extends('plantilla')

@section('titulo', 'Inicio')

@section('contenido')
<div class="text-center py-5">
    <div class="card bg-dark border-warning shadow-lg p-5">
        <h1 class="display-4 fw-bold text-warning mb-4">¡Bienvenido a CardMaster!</h1>
        <p class="fs-4 mb-5">Tienes un saldo de <span class="text-success fw-bold">{{ Auth::user()->wallet }}€</span> para empezar tu aventura.</p>

        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <a href="{{ route('tienda.index') }}" class="btn btn-warning btn-lg w-100 fw-bold py-3 shadow">🛒 IR A LA TIENDA</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('album.index') }}" class="btn btn-outline-warning btn-lg w-100 fw-bold py-3 shadow">📖 VER MI ÁLBUM</a>
            </div>
        </div>
    </div>
</div>
@endsection