<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

/*
| Web Routes - CardMaster 2026
|--------------------------------------------------------------------------
*/

// --- RUTAS DE AUTENTICACIÓN ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('name', 'password');

    // Lógica especial para admin/admin
    if ($request->name == 'admin' && $request->password == 'admin') {
        $user = User::where('name', 'admin')->first();

        if (!$user) {
            // Si no existe, lo creamos con el email que faltaba
            $user = User::create([
                'name' => 'admin',
                'email' => 'admin@cardmaster.com',
                'password' => Hash::make('admin'),
                'wallet' => 10000
            ]);
        } else {
            // SI YA EXISTE: Forzamos los 10.000€ y guardamos en la DB
            $user->wallet = 10000;
            $user->save();
        }

        Auth::login($user);
        // Regeneramos la sesión para asegurar que el saldo se lea bien
        $request->session()->regenerate();

        return redirect()->route('inicio')->with('success', 'Bienvenido Admin, saldo de 10.000€ activado.');
    }

    // Login estándar para otros usuarios
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('inicio');
    }

    return back()->with('error', 'Usuario o contraseña incorrectos');
})->name('login.post');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');


// --- RUTAS DEL JUEGO (Protegidas) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('/tienda', function () {
        return view('tienda');
    })->name('tienda.index');

    Route::get('/album', [JuegoController::class, 'mostrarAlbum'])->name('album.index');

    Route::post('/comprar/{tipo}', [JuegoController::class, 'comprar'])->name('comprar.sobre');
    Route::post('/vender/{id}', [JuegoController::class, 'vender'])->name('carta.vender');
    Route::post('/coleccionar/{id}', [JuegoController::class, 'coleccionar'])->name('carta.coleccionar');
});