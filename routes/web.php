<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

// --- LOGIN ---
Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('name', 'password');

    if ($request->name == 'admin' && $request->password == 'admin') {
        $user = User::updateOrCreate(
            ['name' => 'admin'],
            ['email' => 'admin@admin.com', 'password' => Hash::make('admin'), 'wallet' => 10000]
        );
        Auth::login($user);
        return redirect()->route('inicio')->with('success', 'Modo Administrador activado: 10.000€.');
    }

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/')->with('success', '¡Has vuelto al juego!');
    }
    return back()->with('error', 'Usuario o contraseña incorrectos.');
})->name('login.post');

// --- REGISTRO CON MENSAJES ---
Route::get('/register', function () { return view('auth.register'); })->name('register');

Route::post('/register', function (Request $request) {
    try {
        $request->validate([
            'name' => 'required|unique:users|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'wallet' => 50
        ]);

        Auth::login($user);
        return redirect()->route('inicio')->with('success', '¡Usuario creado con éxito! Empiezas con 50€.');

    } catch (\Exception $e) {
        return back()->with('error', 'No se pudo crear el usuario. El nombre o email ya podrían estar en uso.');
    }
})->name('register.post');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
})->name('logout');

// --- JUEGO ---
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () { return view('inicio'); })->name('inicio');
    Route::get('/tienda', function () { return view('tienda'); })->name('tienda.index');
    Route::get('/album', [JuegoController::class, 'mostrarAlbum'])->name('album.index');
    Route::post('/comprar/{tipo}', [JuegoController::class, 'comprar'])->name('comprar.sobre');
    Route::post('/vender/{id}', [JuegoController::class, 'vender'])->name('carta.vender');
    Route::post('/coleccionar/{id}', [JuegoController::class, 'coleccionar'])->name('carta.coleccionar');
});