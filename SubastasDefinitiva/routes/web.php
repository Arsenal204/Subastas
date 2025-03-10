<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RolManager;
use App\Http\Controllers\SubastaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ComentarioController;


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
});

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

// Ruta para agregar un comentario a un producto
Route::post('/productos/{id}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
require __DIR__.'/auth.php';
