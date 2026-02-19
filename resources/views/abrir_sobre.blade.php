@extends('plantilla')

<<<<<<< HEAD
@section('titulo', 'Abriendo Sobre')

@section('contenido')
<div class="container text-center py-4">
    <h2 class="text-warning mb-5 fw-bold" style="text-shadow: 0 0 10px rgba(255,193,7,0.5)">
        ✨ ¡RECOMPENSAS DEL SOBRE! ✨
    </h2>

    <div class="row row-cols-1 row-cols-md-5 g-4 justify-content-center">
        @foreach($cartas as $carta)
            <div class="col" id="contenedor-{{ $carta->id }}">
                <div class="card bg-dark border-secondary text-white h-100 shadow-lg card-carta">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $carta->name }}</h5>

                        <div class="my-2">
                            <span class="badge {{ $carta->rarity == 'Legendaria' ? 'bg-danger' : ($carta->rarity == 'Épica' ? 'bg-primary' : 'bg-secondary') }}">
                                {{ $carta->rarity }}
                            </span>
                        </div>

                        <p class="text-success fw-bold fs-5 mt-auto">{{ $carta->sell_price }}€</p>

                        <div class="d-grid gap-2 mt-3">
                            <button id="btn-col-{{ $carta->id }}"
                                    onclick="coleccionarCarta({{ $carta->id }})"
                                    class="btn btn-warning fw-bold shadow-sm">
                                📖 Coleccionar
                            </button>

                            <button id="btn-ven-{{ $carta->id }}"
                                    onclick="venderCarta({{ $carta->id }})"
                                    class="btn btn-outline-danger btn-sm">
                                💰 Vender
                            </button>
=======
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
>>>>>>> 0043b4df1a11d3d38597e6df1c0fa4412fa5b41b
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        @endforeach
    </div>

    <div class="mt-5">
        <a href="{{ route('tienda.index') }}" class="btn btn-lg btn-primary px-5 fw-bold shadow">
            VOLVER A LA TIENDA
        </a>
    </div>
</div>

<style>
    .card-carta { transition: transform 0.3s; }
    .card-carta:hover { transform: translateY(-10px); border-color: #ffc107 !important; }
</style>

<script>
// Función para guardar la carta en el álbum (inventories)
function coleccionarCarta(id) {
    const btnCol = document.getElementById(`btn-col-${id}`);
    const btnVen = document.getElementById(`btn-ven-${id}`);

    fetch(`/coleccionar/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Llave de seguridad obligatoria
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Cambio visual: Desactivamos botones y marcamos como guardada
            btnCol.className = "btn btn-success disabled w-100";
            btnCol.innerHTML = "✅ Guardada";
            btnVen.style.display = "none";

            // Efecto visual en la carta
            document.getElementById(`contenedor-${id}`).style.filter = "drop-shadow(0 0 10px #198754)";
        } else {
            alert('Error al coleccionar: ' + (data.message || 'Desconocido'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un problema con la conexión al servidor.');
    });
}

// Función para vender la carta y sumar dinero al wallet
function venderCarta(id) {
    if(!confirm('¿Seguro que quieres vender esta carta?')) return;

    fetch(`/vender/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
=======
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
<<<<<<< HEAD
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
=======
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
>>>>>>> 0043b4df1a11d3d38597e6df1c0fa4412fa5b41b
        }
    })
    .then(response => response.json())
    .then(data => {
<<<<<<< HEAD
        if(data.success) {
            // Eliminamos la carta de la vista
            document.getElementById(`contenedor-${id}`).remove();

            // Actualizamos el saldo en el layout superior
            const saldoDisplay = document.getElementById('saldo-display');
            if(saldoDisplay) {
                saldoDisplay.innerText = `💰 ${data.nuevo_saldo}€`;
            }
        }
    });
}
</script>
@endsection
=======
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
>>>>>>> 0043b4df1a11d3d38597e6df1c0fa4412fa5b41b
>>>>>>> SrMaurons1.0
