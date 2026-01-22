@extends('plantilla')

@section('titulo', 'Mi Colección')

@section('contenido')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="fw-bold text-white">🎴 Mi Álbum de Cartas</h1>
        <span class="badge bg-primary fs-5">{{ count($misCartasIds) }} / {{ count($todasLasCartas) }}</span>
    </div>

    <div class="row g-4">
        @foreach($todasLasCartas as $carta)
            @php $poseida = in_array($carta->id, $misCartasIds); @endphp
            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 border-2 {{ $poseida ? 'border-warning shadow' : 'border-secondary grayscale opacity-50' }}"
                     style="background-color: #16213e; border-radius: 12px; transition: transform 0.2s;">

                    <div class="card-body text-center d-flex flex-column justify-content-center" style="min-height: 180px;">
                        @if($poseida)
                            <div class="rounded mb-2" style="background-color: #28a745; height: 100px;"></div>
                            <h6 class="text-white fw-bold mb-0 small">{{ $carta->name }}</h6>
                            <span class="badge bg-dark mt-1" style="font-size: 0.6rem;">{{ $carta->rarity }}</span>
                        @else
                            <h1 class="text-secondary mb-0">?</h1>
                            <p class="text-secondary small mt-1">Bloqueada</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .grayscale { filter: grayscale(100%); }
    .card:hover { transform: scale(1.05); }
</style>
@endsection