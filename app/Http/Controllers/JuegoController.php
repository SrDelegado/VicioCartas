<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JuegoController extends Controller
{
    public function mostrarAlbum()
    {
        $todasLasCartas = Card::all();
        $misCartasIds = DB::table('inventories')
            ->where('user_id', Auth::id())
            ->pluck('card_id')
            ->toArray();

        return view('album', compact('todasLasCartas', 'misCartasIds'));
    }

    public function comprar($tipo)
    {
        $precios = ['bronce' => 10, 'plata' => 50, 'oro' => 100];
        if (!isset($precios[$tipo])) return abort(404);

        $user = Auth::user();
        if ($user->wallet < $precios[$tipo]) {
            return back()->with('error', 'Saldo insuficiente');
        }

        return DB::transaction(function () use ($user, $tipo, $precios) {
            $user->wallet -= $precios[$tipo];
            $user->save();

            $cartasObtenidas = Card::inRandomOrder()->limit(5)->get();

            return view('abrir_sobre', [
                'cartas' => $cartasObtenidas,
                'tipo' => $tipo
            ]);
        });
    }

    public function coleccionar($id)
    {
        $exists = DB::table('inventories')
            ->where('user_id', Auth::id())
            ->where('card_id', $id)
            ->exists();

        if (!$exists) {
            DB::table('inventories')->insert([
                'user_id' => Auth::id(),
                'card_id' => $id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Ya la tienes']);
    }

    public function vender($id)
    {
        $carta = Card::find($id);
        $user = Auth::user();

        if ($carta) {
            $user->wallet += $carta->sell_price;
            $user->save();
            return response()->json(['success' => true, 'nuevo_saldo' => $user->wallet]);
        }
        return response()->json(['success' => false]);
    }
}