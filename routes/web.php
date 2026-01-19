<?php

use Illuminate\Support\Facades\Route;

// 1. Inicio: Pantalla principal del juego (Saldo y bienvenida)
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// 2. Catálogo: La tienda de sobres (Baratos, Caros, Muy Caros)
Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda.index');

// 3. Contacto: Soporte o información
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// 4. Álbum: Para ver las cartas coleccionadas (Ruta con nombre)
Route::get('/album', function () {
    return view('album');
})->name('album.index');