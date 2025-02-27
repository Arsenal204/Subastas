<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rutas del pago
use App\Http\Controllers\PagoController;

Route::get('pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::get('pagos/create', [PagoController::class, 'crear'])->name('pagos.crear');
Route::post('pagos', [PagoController::class, 'tienda'])->name('pagos.tienda');
Route::get('pagos/{id}', [PagoController::class, 'mostrar'])->name('pagos.mostrar');
Route::get('pagos/{id}/edit', [PagoController::class, 'editar'])->name('pagos.editar');
Route::put('pagos/{id}', [PagoController::class, 'actualizar'])->name('pagos.actualizar');
Route::delete('pagos/{id}', [PagoController::class, 'eliminar'])->name('pagos.eliminar');


require __DIR__.'/auth.php';
