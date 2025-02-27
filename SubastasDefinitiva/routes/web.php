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
Route::get('pagos/create', [PagoController::class, 'create'])->name('pagos.create');
Route::post('pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
Route::get('pagos/{id}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
Route::put('pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');
Route::delete('pagos/{id}', [PagoController::class, 'destroy'])->name('pagos.destroy');


require __DIR__.'/auth.php';
