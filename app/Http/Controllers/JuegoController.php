<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class JuegoController
{
    /**
     * Compra un sobre, descuenta saldo y elige cartas de la DB.
     */
    public function comprar($tipo)
    {
        $user = Auth::user();

        // 1. Definir precios y cantidades
        $precios = [
            'bronce' => 10,
            'oro' => 50,
            'epico' => 100
        ];

        if (!isset($precios[$tipo])) {
            return redirect()->back()->with('error', 'El sobre no existe.');
        }

        $coste = $precios[$tipo];

        // 2. Verificar si el usuario tiene dinero
        if ($user->wallet < $coste) {
            return redirect()->route('tienda.index')->with('error', 'No tienes saldo suficiente.');
        }

        // 3. Restar dinero y guardar en la DB
        $user->wallet -= $coste;
        $user->save();

        // 4. Determinar cantidad de cartas y obtenerlas de forma aleatoria
        $cantidad = ($tipo === 'bronce') ? 3 : 5;
        $cartasObtenidas = DB::table('cards')->inRandomOrder()->limit($cantidad)->get();

        return view('abrir_sobre', [
            'cartas' => $cartasObtenidas,
            'tipo' => $tipo
        ]);
    }

    /**
     * Vende una carta y añade el precio al saldo del usuario.
     */
    public function vender($id)
    {
        $user = Auth::user();
        $carta = DB::table('cards')->where('id', $id)->first();

        if (!$carta) {
            return response()->json(['success' => false], 404);
        }

        // Añadir dinero a la cuenta
        $user->wallet += $carta->sell_price;
        $user->save();

        return response()->json([
            'success' => true,
            'nuevo_saldo' => $user->wallet
        ]);
    }

    /**
     * Guarda la carta en la tabla de inventario del usuario.
     */
    public function coleccionar($id)
    {
        $user = Auth::user();

        // Insertar relación en la tabla inventories
        DB::table('inventories')->insert([
            'user_id' => $user->id,
            'card_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Muestra todas las cartas y marca cuáles tiene el usuario.
     */
    public function mostrarAlbum()
    {
        // Traer las 20 cartas de la base de datos
        $todasLasCartas = DB::table('cards')->get();

        // Obtener solo los IDs de las cartas que ya tiene el usuario
        $misCartasIds = DB::table('inventories')
            ->where('user_id', Auth::id())
            ->pluck('card_id')
            ->toArray();

        return view('album', [
            'todasLasCartas' => $todasLasCartas,
            'misCartasIds' => $misCartasIds
        ]);
    }
}