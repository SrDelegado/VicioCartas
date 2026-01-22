@extends('plantilla')

@section('titulo', 'Bienvenido')

@section('contenido')
    <div class="text-center">
        <h1 class="display-4">¡Bienvenido al Desafío de los Sobres!</h1>
        <p class="lead">Tienes 100€ para empezar tu colección. ¿Te sientes con suerte?</p>
        <hr>
        <a href="{{ route('tienda.index') }}" class="btn btn-primary btn-lg">Ir a la Tienda</a>
    </div>
@endsection