@extends('plantilla')

@section('titulo', 'Tienda de Sobres')

@section('contenido')
<div class="container text-center py-5">
    <h1 class="display-4 fw-bold mb-2 text-white">🏪 Mercado de Cartas</h1>
    <p class="lead mb-5 text-secondary">Gasta tus monedas con sabiduría para completar la colección.</p>

    <div class="row g-4 justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card card-pack pack-bronce h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <div class="display-1 mb-3">📦</div>
                        <h3 class="card-title fw-bold text-white">Sobre Bronce</h3>
                        <p class="text-muted">Contiene 3 cartas comunes con baja probabilidad de raras.</p>
                    </div>
                    <div class="mt-4">
                        <h2 class="text-success fw-bold mb-3">10€</h2>
                        <form action="{{ route('comprar.sobre', 'bronce') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">COMPRAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card card-pack pack-oro h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <div class="display-1 mb-3">✨</div>
                        <h3 class="card-title fw-bold text-white">Sobre Oro</h3>
                        <p class="text-muted">Contiene 5 cartas con al menos una **Rara** garantizada.</p>
                    </div>
                    <div class="mt-4">
                        <h2 class="text-success fw-bold mb-3">50€</h2>
                        <form action="{{ route('comprar.sobre', 'oro') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm text-dark">COMPRAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card card-pack pack-epico h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <div class="display-1 mb-3">🔮</div>
                        <h3 class="card-title fw-bold text-white">Sobre Épico</h3>
                        <p class="text-muted">Alta probabilidad de cartas **Legendarias** y brillantes.</p>
                    </div>
                    <div class="mt-4">
                        <h2 class="text-success fw-bold mb-3">100€</h2>
                        <form action="{{ route('comprar.sobre', 'epico') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold shadow-sm">COMPRAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-4">
        <a href="{{ route('inicio') }}" class="text-decoration-none text-muted small">← Volver al inicio</a>
    </div>
</div>
@endsection