<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JuegoController extends Controller
{
    // Muestra el álbum con las cartas conseguidas
    public function mostrarAlbum()
    {
        $todasLasCartas = Card::all();
        $misCartasIds = DB::table('inventories')
            ->where('user_id', Auth::id())
            ->pluck('card_id')
            ->toArray();

        return view('album', [
            'todasLasCartas' => $todasLasCartas,
            'misCartasIds' => $misCartasIds
        ]);
    }

    // Lógica para comprar un sobre
    public function comprar($tipo)
    {
        $precios = ['comun' => 10, 'raro' => 50, 'epico' => 100];
        $user = Auth::user();

        if ($user->wallet < $precios[$tipo]) {
            return back()->with('error', 'No tienes suficiente dinero.');
        }

        // Restar dinero
        $user->wallet -= $precios[$tipo];
        $user->save();

        // Lógica de probabilidad de cartas
        $cartasObtenidas = Card::inRandomOrder()->limit(5)->get();

        // Guardamos temporalmente en la sesión para que el usuario elija qué hacer
        session(['cartas_pendientes' => $cartasObtenidas]);

        return view('abrir_sobre', ['cartas' => $cartasObtenidas]);
    }

    // Lógica para COLECCIONAR (Guardar en el Álbum)
    public function coleccionar($id)
    {
        $user = Auth::user();

        // Verificamos si ya la tiene para no duplicar en el álbum
        $existe = DB::table('inventories')
            ->where('user_id', $user->id)
            ->where('card_id', $id)
            ->exists();

        if (!$existe) {
            DB::table('inventories')->insert([
                'user_id' => $user->id,
                'card_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Carta añadida al álbum']);
    }

    // Lógica para VENDER (Ganar dinero)
    public function vender($id)
    {
        $carta = Card::find($id);
        $user = Auth::user();

        if ($carta) {
            $user->wallet += $carta->sell_price;
            $user->save();
            return response()->json(['success' => true, 'nuevo_saldo' => $user->wallet]);
        }

        return response()->json(['success' => false], 404);
    }
}