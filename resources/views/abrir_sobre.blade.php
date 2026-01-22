@extends('plantilla')

@section('contenido')
<div class="container text-center py-5">
    <div id="sobre-cerrado" class="mx-auto bg-warning d-flex align-items-center justify-content-center shadow-lg mb-5"
         style="width: 200px; height: 300px; cursor: pointer; border-radius: 15px; border: 4px solid #b8860b;"
         onclick="abrirSobre()">
        <h2 class="text-dark fw-bold">SOBRE {{ strtoupper($tipo) }}<br><small>(Click para abrir)</small></h2>
    </div>

    <div id="recompensa" class="d-none">
        <h2 class="mb-4 text-white">¡Tus nuevas cartas!</h2>
        <div class="row justify-content-center g-3">
            @foreach($cartas as $carta)
            <div class="col-6 col-md-2" id="contenedor-carta-{{ $carta->id }}">
                <div class="card-inner" onclick="girarCarta(this)">
                    <div class="card-flipper">
                        <div class="card-front bg-secondary border border-light">
                            <span class="fs-1 text-white-50">?</span>
                        </div>
                        <div class="card-back border" style="background-color: #28a745;">
                            <div class="p-2 w-100">
                                <span class="badge bg-dark mb-1">{{ $carta->rarity }}</span>
                                <h6 class="fw-bold text-truncate">{{ $carta->name }}</h6>
                                <p class="small mb-2">{{ $carta->sell_price }}€</p>
                                <div class="d-grid gap-1">
                                    <button class="btn btn-sm btn-light py-1 fw-bold"
                                            onclick="accionCarta(event, 'coleccionar', {{ $carta->id }})">
                                        Coleccionar
                                    </button>
                                    <button class="btn btn-sm btn-danger py-1 fw-bold"
                                            onclick="accionCarta(event, 'vender', {{ $carta->id }})">
                                        Vender
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5">
            <a href="{{ route('tienda.index') }}" class="btn btn-outline-info">Volver a la Tienda</a>
        </div>
    </div>
</div>

<script>
function abrirSobre() {
    document.getElementById('sobre-cerrado').classList.add('d-none');
    document.getElementById('recompensa').classList.remove('d-none');
}

function girarCarta(elemento) {
    elemento.classList.toggle('flipped');
}

function accionCarta(event, tipo, id) {
    // IMPORTANTE: Esto evita que la carta se gire al pulsar el botón
    event.stopPropagation();

    const url = tipo === 'vender' ? `/vender/${id}` : `/coleccionar/${id}`;

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Animación simple para hacer desaparecer la carta
            const card = document.getElementById(`contenedor-carta-${id}`);
            card.style.transition = '0.5s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.5)';

            setTimeout(() => card.remove(), 500);

            // Si vendemos, actualizamos el saldo real en el navbar
            if (tipo === 'vender' && data.nuevo_saldo !== undefined) {
                const saldoDisplay = document.getElementById('saldo-display');
                if (saldoDisplay) {
                    saldoDisplay.innerText = `💰 ${data.nuevo_saldo}€`;
                }
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

<style>
.card-inner { height: 250px; perspective: 1000px; cursor: pointer; }
.card-flipper { position: relative; width: 100%; height: 100%; transition: transform 0.6s; transform-style: preserve-3d; }
.card-inner.flipped .card-flipper { transform: rotateY(180deg); }
.card-front, .card-back { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; border-radius: 10px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
.card-back { transform: rotateY(180deg); color: white; overflow: hidden; }
</style>
@endsection
