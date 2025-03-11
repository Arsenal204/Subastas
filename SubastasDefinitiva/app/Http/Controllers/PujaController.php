<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use App\Models\Puja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PujaController extends Controller
{
    public function pujar(Request $request, $id)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar una puja.');
        }

        // Obtener la subasta
        $subasta = Subasta::findOrFail($id);

        // Validar que la puja sea mayor que el precio actual
        $request->validate([
            'monto' => 'required|numeric|min:' . ($subasta->precio_actual + 1),
        ]);

        // Verificar que el monto de la puja sea mayor que el precio actual
        if ($request->monto <= $subasta->precio_actual) {
            return redirect()->back()->with('error', 'El monto de la puja debe ser mayor al precio actual.');
        }

        // Crear la puja
        Puja::create([
            'user_id' => Auth::id(),
            'subasta_id' => $subasta->id,
            'monto' => $request->monto,
        ]);

        // Actualizar el precio actual de la subasta
        $subasta->precio_actual = $request->monto;
        $subasta->save();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Puja realizada con éxito.');
    }
}
