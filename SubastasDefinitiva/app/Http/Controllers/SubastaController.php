<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Subasta;
use Illuminate\Support\Facades\Auth;



class SubastaController extends Controller
{
    public function dashboard() {
        $subastas = Subasta::where('estado', 'activa')
            ->where('fecha_inicio', '<=', Carbon::now())
            ->where('fecha_fin', '>=', Carbon::now())
            ->get();

        return view('dashboard', compact('subastas'));
    }

    public function vendedorDashboard() {
        $usuario = Auth::user();
        $subastas = Subasta::where('user_id', $usuario->id)->get();

        return view('vendedor', compact('subastas'));
    }

public function adminSubastas() {
    $subastas = Subasta::all();
    return view('admin', compact('subastas'));
}



}
