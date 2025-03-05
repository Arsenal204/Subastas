<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Subasta;



class SubastaController extends Controller
{
    public function dashboard() {
        $subastas = Subasta::where('estado', 'activa')
            ->where('fecha_inicio', '<=', Carbon::now())
            ->where('fecha_fin', '>=', Carbon::now())
            ->get();

        return view('dashboard', compact('subastas'));
    }



}
