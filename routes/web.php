<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

// --- RUTAS PÚBLICAS (GUEST) ---
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// --- LÓGICA DE ACCESO ---
Route::post('/login', function (Request $request) {
    // Validamos primero
    $request->validate([
        'name' => 'required',
        'password' => 'required',
    ]);

    // Lógica especial para admin (mejor en un Seeder, pero corregido aquí)
    if ($request->name == 'admin' && $request->password == 'admin') {
        $user = User::firstOrCreate(
            ['name' => 'admin'],
            [
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'wallet' => 10000
            ]
        );
        Auth::login($user);
        return redirect()->route('inicio');
    }

    if (Auth::attempt($request->only('name', 'password'))) {
        $request->session()->regenerate(); // Seguridad: regenera la sesión
        return redirect()->intended('/')->with('success', '¡Bienvenido!');
    }

    return back()->with('error', 'Credenciales incorrectas');
})->name('login.post');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'wallet' => 50
    ]);

    Auth::login($user);
    return redirect()->route('inicio');
})->name('register.post');

// --- JUEGO (RUTAS PROTEGIDAS) ---
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('/tienda', function () {
        return view('tienda');
    })->name('tienda.index');

    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

    // Rutas del Controlador
    Route::get('/album', [JuegoController::class, 'mostrarAlbum'])->name('album.index');
    Route::post('/comprar/{tipo}', [JuegoController::class, 'comprar'])->name('comprar.sobre');
    Route::post('/vender/{id}', [JuegoController::class, 'vender'])->name('carta.vender');
    Route::post('/coleccionar/{id}', [JuegoController::class, 'coleccionar'])->name('carta.coleccionar');
});