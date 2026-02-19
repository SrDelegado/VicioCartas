<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

<<<<<<< HEAD
// --- RUTAS PÚBLICAS (GUEST) ---
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
=======
/*
| Web Routes - CardMaster 2026
|--------------------------------------------------------------------------
*/

// --- RUTAS DE AUTENTICACIÓN ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
>>>>>>> SrMaurons1.0

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

<<<<<<< HEAD
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

=======
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
>>>>>>> SrMaurons1.0
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('/tienda', function () {
        return view('tienda');
    })->name('tienda.index');

<<<<<<< HEAD
    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

    // Rutas del Controlador
=======
>>>>>>> SrMaurons1.0
    Route::get('/album', [JuegoController::class, 'mostrarAlbum'])->name('album.index');

    Route::post('/comprar/{tipo}', [JuegoController::class, 'comprar'])->name('comprar.sobre');
    Route::post('/vender/{id}', [JuegoController::class, 'vender'])->name('carta.vender');
    Route::post('/coleccionar/{id}', [JuegoController::class, 'coleccionar'])->name('carta.coleccionar');
});