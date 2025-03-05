<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Subasta;



class SubastaController extends Controller
{
public function dashboard()
{
    $subastas = Subasta::where('estado', 'activa')
    ->where('fecha_inicio', '<=', now())
    ->where('fecha_fin', '>=', now())
    ->with('productos') // 🔹 Cargar los productos relacionados
    ->get();


    return view('dashboard', compact('subastas')); // 🔹 Pasar la variable a la vista
}



}
