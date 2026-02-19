@extends('plantilla')

@section('contenido')
<div class="container text-center py-5">
    <h1 class="mb-5 text-dark">Tienda de Sobres</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card shadow border-0 mb-4">
                <div class="card-body bg-secondary text-white rounded">
                    <h3>BRONCE</h3>
                    <p class="fs-4">10€</p>
                    <form action="{{ route('comprar.sobre', 'bronce') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light fw-bold">Comprar Sobre</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-0 mb-4">
                <div class="card-body bg-info text-white rounded">
                    <h3>PLATA</h3>
                    <p class="fs-4">50€</p>
                    <form action="{{ route('comprar.sobre', 'plata') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light fw-bold">Comprar Sobre</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-0 mb-4">
                <div class="card-body bg-warning text-dark rounded">
                    <h3>ORO</h3>
                    <p class="fs-4">100€</p>
                    <form action="{{ route('comprar.sobre', 'oro') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark fw-bold">Comprar Sobre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection