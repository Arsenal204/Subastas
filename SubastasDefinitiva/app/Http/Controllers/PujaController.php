<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subasta;
use App\Models\Puja;
use Illuminate\Support\Facades\Auth;

class PujaController extends Controller
{
    public function pujar(Request $request, $id)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar una puja.');
        }

        // Validamos el monto ingresado
        $request->validate([
            'monto' => 'required|numeric|min:0'
        ]);

        // Buscar la subasta en la base de datos
        $subasta = Subasta::findOrFail($id);

        // Validamos que la puja sea mayor al precio actual
        if ($request->monto <= $subasta->precio_actual) {
            return redirect()->back()->with('error', 'El monto de la puja debe ser mayor al precio actual.');
        }

        // Guardamos la puja en la base de datos
        $puja = new Puja();
        $puja->user_id = Auth::id();
        $puja->subasta_id = $subasta->id;
        $puja->monto = $request->monto;
        $puja->save();

        // Actualizar el precio actual de la subasta
        $subasta->precio_actual = $request->monto;
        $subasta->save();

        return redirect()->back()->with('success', 'Puja realizada con éxito.');
    }
}
