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
Route::get('pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::get('pagos/create', [PagoController::class, 'crear'])->name('pagos.crear');
Route::post('pagos', [PagoController::class, 'tienda'])->name('pagos.tienda');
Route::get('pagos/{id}', [PagoController::class, 'mostrar'])->name('pagos.mostrar');
Route::get('pagos/{id}/edit', [PagoController::class, 'editar'])->name('pagos.editar');
Route::put('pagos/{id}', [PagoController::class, 'actualizar'])->name('pagos.actualizar');
Route::delete('pagos/{id}', [PagoController::class, 'eliminar'])->name('pagos.eliminar');


require __DIR__.'/auth.php';
