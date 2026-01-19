@extends('plantilla')

@section('titulo', 'Inicio')

@section('contenido')
    <h1>¡Bienvenido a CardMaster!</h1>
    <p>Empieza con 100€ y completa tu colección abriendo sobres.</p>
    <a href="{{ route('tienda.index') }}" class="btn btn-primary">Ir a la Tienda</a>
@endsection