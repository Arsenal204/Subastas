<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RolManager;
use App\Http\Controllers\SubastaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MensajeController;

use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PujaController;



use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolmanager:user'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin');
})->middleware(['auth', 'verified', 'rolmanager:admin'])->name('admin');

Route::get('/vendedor/dashboard', function () {
    return view('vendedor');
})->middleware(['auth', 'verified', 'rolmanager:vendedor'])->name('vendedor');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Ruta de cierre de sesión
  Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
});

// Rutas de autenticación con GitHub
Route::middleware('guest')->group(function () {
    // Rutas de autenticación con GitHub solo para invitados
    Route::get('auth/github', [SocialAuthController::class, 'redirectToGitHub'])->name('auth.github');
    Route::get('auth/github/callback', [SocialAuthController::class, 'handleGitHubCallback'])->name('auth.github.callback');
});

Route::post('/subastas/{id}/pujar', [PujaController::class, 'pujar'])->name('subastas.pujar');

//Rutas de la subasta

Route::get('/dashboard', [SubastaController::class, 'dashboard'])->name('dashboard');
Route::get('/vendedor', [SubastaController::class, 'vendedorDashboard'])->name('vendedor');
Route::get('/admin/subastas', [SubastaController::class, 'adminSubastas'])->name('admin');

Route::get('/subastas/{id}/edit', [SubastaController::class, 'edit'])->name('subastas.edit');
Route::get('/subastas/create', [SubastaController::class, 'create'])->name('subastas.create');
Route::get('/subastas/{id}', [SubastaController::class, 'show'])->name('subastas.show');

Route::post('/subastas', [SubastaController::class, 'store'])->name('subastas.store');
Route::put('/subastas/{id}', [SubastaController::class, 'update'])->name('subastas.update');


Route::delete('/subastas/{id}', [SubastaController::class, 'destroy'])->name('subastas.destroy');
Route::patch('/subastas/{id}/cancelar', [SubastaController::class, 'cancelar'])->name('subastas.cancelar');
Route::resource('subastas', SubastaController::class);

// Rutas de comentarios
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::get('/comentarios/{comentario}/edit', [ComentarioController::class, 'edit'])->name('comentarios.edit');
Route::put('/comentarios/{comentario}', [ComentarioController::class, 'update'])->name('comentarios.update');
Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');




//auth
Route::middleware(['auth'])->group(function () {
    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
    Route::post('/pagos/checkout', [PagoController::class, 'checkout'])->name('pagos.checkout');
});

Route::get('/pagos/exito', function () {
    return "Pago realizado con éxito.";
})->name('pagos.exito');

Route::get('/pagos/fallo', function () {
    return "Hubo un error en el pago.";
})->name('pagos.fallo');

// Detalles del producto
// Ruta para mostrar el detalle de un producto
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

// Ruta para hacer una oferta en una subasta
Route::post('/subastas/{subasta}/pujar', [SubastaController::class, 'pujar'])->name('subastas.pujar');

// Rutas para el chat
Route::middleware('auth')->group(function () {
   // Ruta para el chat entre dos usuarios
Route::get('/chat', [MensajeController::class, 'index'])->name('chat.index');

// Ruta para enviar un mensaje
Route::post('/chat/send', [MensajeController::class, 'send'])->name('chat.send');
});

// Rutas de productos
Route::get('/dashboard/search', [CategoriaController::class, 'buscarPorCategoria'])->name('dashboard.search');

// Rutas de productos
Route::resource('categorias', CategoriaController::class);
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'crear'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'tienda'])->name('categorias.tienda');
Route::get('/categorias/{id}/editar', [CategoriaController::class, 'edit'])->name('categorias.editar');
Route::put('/categorias/{id}', [CategoriaController::class, 'actualizar'])->name('categorias.actualizar');
Route::delete('/categorias/{id}', [CategoriaController::class, 'eliminar'])->name('categorias.eliminar');

//Ruta para la puja
Route::post('/subastas/{id}/pujar', [PujaController::class, 'pujar'])->name('subastas.pujar');


// Ruta para agregar un comentario a un producto
Route::post('/productos/{id}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
require __DIR__.'/auth.php';
