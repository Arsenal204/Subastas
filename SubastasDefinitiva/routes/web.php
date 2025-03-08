<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RolManager;
use App\Http\Controllers\SubastaController;
use App\Http\Controllers\PagoController;


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



Route::get('/subastas/{id}', [SubastaController::class, 'show'])->name('subastas.show');
Route::get('/subastas/create', [SubastaController::class, 'create'])->name('subastas.create');
Route::post('/subastas', [SubastaController::class, 'store'])->name('subastas.store');
Route::get('/subastas/{id}/edit', [SubastaController::class, 'edit'])->name('subastas.edit');
Route::put('/subastas/{id}', [SubastaController::class, 'update'])->name('subastas.update');
Route::delete('/subastas/{id}', [SubastaController::class, 'destroy'])->name('subastas.destroy');
Route::resource('subastas', SubastaController::class);



//Rutas del pago

Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::post('/pagos/checkout', [PagoController::class, 'checkout'])->name('pagos.checkout');

Route::get('/pagos/exito', function () {
    return "Pago exitoso.";
})->name('pagos.exito');

Route::get('/pagos/fallo', function () {
    return "El pago falló.";
})->name('pagos.fallo');



require __DIR__.'/auth.php';
