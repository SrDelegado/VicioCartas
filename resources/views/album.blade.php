@extends('plantilla')

@section('contenido')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="text-dark fw-bold">Mi Álbum de Cartas</h1>
        <div class="bg-white p-3 rounded shadow-sm border">
            <h5 class="mb-0 text-muted">Progreso:
                <span class="text-primary">{{ count($misCartasIds) }}</span> / {{ count($todasLasCartas) }}
            </h5>
        </div>
    </div>

    <div class="row g-4">
        @foreach($todasLasCartas as $carta)
            @php
                $poseida = in_array($carta->id, $misCartasIds);
            @endphp
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 shadow-sm border-0 position-relative {{ $poseida ? '' : 'grayscale' }}"
                     style="transition: transform 0.3s; border-radius: 12px; overflow: hidden;">

                    <img src="{{ $carta->image_url }}" class="card-img-top p-2"
                         style="height: 150px; object-fit: contain; background: #f8f9fa;"
                         alt="{{ $carta->name }}">

                    <div class="card-body p-2 text-center">
                        <span class="badge {{ $poseida ? 'bg-success' : 'bg-secondary' }} mb-1">
                            {{ $poseida ? 'Obtenida' : 'Bloqueada' }}
                        </span>
                        <h6 class="fw-bold mb-0 text-truncate">{{ $carta->name }}</h6>
                        <small class="text-muted">{{ strtoupper($carta->rarity) }}</small>
                    </div>

                    @if(!$poseida)
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <i class="fs-1 text-white opacity-75">🔒</i>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('tienda.index') }}" class="btn btn-primary btn-lg px-5 shadow">Ir a la Tienda</a>
    </div>
</div>

<style>
    /* Estilo para poner en gris las cartas no obtenidas */
    .grayscale {
        filter: grayscale(100%) blur(1px);
        opacity: 0.7;
    }

    .card:hover {
        transform: translateY(-5px);
        z-index: 10;
    }

    .grayscale:hover {
        filter: grayscale(50%);
        opacity: 0.9;
    }
</style>
@endsection