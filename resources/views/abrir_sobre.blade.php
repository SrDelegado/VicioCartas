@extends('plantilla')

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
                        </div>
                    </div>
                </div>
            </div>
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
        }
    })
    .then(response => response.json())
    .then(data => {
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