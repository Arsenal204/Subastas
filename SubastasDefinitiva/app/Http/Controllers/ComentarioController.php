<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Subasta;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, $subasta_id)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);
    
        // Crear el comentario
        Comentario::create([
            'subasta_id' => $subasta_id,
            'user_id' => auth()->id(),
            'contenido' => $request->contenido,
        ]);
    
        return redirect()->route('subastas.show', $subasta_id)->with('success', 'Comentario agregado con éxito');
    }
}