@extends('plantilla')

@section('contenido')
<div class="container text-center py-5">
    <div id="sobre-cerrado" class="mx-auto bg-warning d-flex align-items-center justify-content-center shadow-lg mb-5"
         style="width: 220px; height: 320px; cursor: pointer; border-radius: 15px; border: 5px solid #b8860b; transition: transform 0.3s;"
         onclick="abrirSobre()">
        <div class="text-dark">
            <h2 class="fw-bold mb-0">SOBRE</h2>
            <h1 class="fw-black">{{ strtoupper($tipo) }}</h1>
            <p class="small">Click para abrir</p>
        </div>
    </div>

    <div id="recompensa" class="d-none">
        <div class="row justify-content-center g-4">
            @foreach($cartas as $carta)
            <div class="col-6 col-md-2" id="contenedor-carta-{{ $carta->id }}">
                <div class="card-inner" onclick="this.classList.toggle('flipped')">
                    <div class="card-flipper">
                        <div class="card-front">
                            <div class="dorso-pattern"></div>
                            <div class="dorso-logo">MC</div>
                        </div>

                        <div class="card-back {{ $carta->rarity == 'oro' ? 'shiny-gold' : '' }}">
                            <div class="p-1 w-100 h-100 d-flex flex-column text-white" style="z-index: 2;">
                                <span class="badge {{ $carta->rarity == 'oro' ? 'bg-warning text-dark' : 'bg-secondary' }} mb-1">
                                    {{ strtoupper($carta->rarity) }}
                                </span>
                                <img src="{{ $carta->image_url }}" class="img-fluid rounded mb-2" style="max-height: 110px; object-fit: contain;">
                                <h6 class="fw-bold small text-truncate">{{ $carta->name }}</h6>
                                <p class="text-info small mb-2">{{ $carta->sell_price }}€</p>

                                <div class="d-grid gap-1 mt-auto">
                                    <button class="btn btn-sm btn-success py-0 fw-bold" onclick="accionCarta(event, 'coleccionar', {{ $carta->id }})">📥</button>
                                    <button class="btn btn-sm btn-danger py-0 fw-bold" onclick="accionCarta(event, 'vender', {{ $carta->id }})">💰</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5">
            <a href="{{ route('tienda.index') }}" class="btn btn-lg btn-outline-dark">Volver a la Tienda</a>
        </div>
    </div>
</div>

<style>
/* Estructura 3D */
.card-inner { height: 260px; perspective: 1000px; cursor: pointer; }
.card-flipper { position: relative; width: 100%; height: 100%; transition: transform 0.6s; transform-style: preserve-3d; }
.card-inner.flipped .card-flipper { transform: rotateY(180deg); }
.card-front, .card-back { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; border-radius: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
.card-back { transform: rotateY(180deg); background-color: #2c3e50; border: 2px solid #fff; }

/* Efecto Dorso */
.card-front { background: radial-gradient(circle, #2c3e50 0%, #000 100%); border: 4px solid #ffc107; }
.dorso-logo { font-family: 'Bangers', cursive; font-size: 3rem; color: #ffc107; z-index: 1; border: 2px solid #ffc107; padding: 10px; border-radius: 50%; }

/* EFECTO BRILLO PARA CARTAS ORO */
.shiny-gold { border: 3px solid #ffc107 !important; }
.shiny-gold::before {
    content: "";
    position: absolute;
    top: -50%; left: -50%; width: 200%; height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
    transform: rotate(45deg);
    animation: shimmer 2s infinite;
    z-index: 1;
}
@keyframes shimmer {
    0% { transform: translateX(-100%) rotate(45deg); }
    100% { transform: translateX(100%) rotate(45deg); }
}
</style>

<script>
function abrirSobre() {
    document.getElementById('sobre-cerrado').style.display = 'none';
    document.getElementById('recompensa').classList.remove('d-none');
}

function accionCarta(event, tipo, id) {
    event.stopPropagation();
    fetch(`/${tipo}/${id}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
    }).then(res => res.json()).then(data => {
        if(data.success) {
            document.getElementById(`contenedor-carta-${id}`).remove();
            if(tipo === 'vender') document.getElementById('saldo-display').innerText = `💰 ${data.nuevo_saldo}€`;
        }
    });
}
</script>
@endsection