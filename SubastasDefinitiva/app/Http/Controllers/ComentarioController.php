<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Subasta; 

class ComentarioController extends Controller
{
    public function show($id)
    {
        $subasta = Subasta::with('comentarios.user')->findOrFail($id); // Asegúrate de que sea "user", no "usuario"
        return view('subastas.show', compact('subasta'));
    }

    public function store(Request $request)
    {
        // Validar la entrada, incluyendo la valoración
        $request->validate([
            'comentario' => 'required|string|max:255',
            'valoracion' => 'required|integer|between:1,5', // Validar que la valoración esté entre 1 y 5
        ]);

        // Crear el comentario
        $comentario = new Comentario();
        $comentario->comentario = $request->comentario;
        $comentario->user_id = auth()->id();
        $comentario->subasta_id = $request->id;
        $comentario->valoracion = $request->valoracion; // Asignar la valoración
        $comentario->moderado = false; // O el valor que corresponda
        $comentario->save();

        // Redirigir a la página de la subasta con un mensaje de éxito
        return redirect()->route('subastas.show', $request->id)->with('success', 'Comentario enviado');
    }

    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);

        // Verificar si el usuario tiene permiso para editar el comentario
        if (auth()->user()->id !== $comentario->user_id && auth()->user()->rol !== 0) {
            return back()->with('error', 'No tienes permiso para editar este comentario.');
        }

        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, Comentario $comentario)
    {
        // Verificar que el usuario tenga permiso para editar
        if (auth()->user()->id !== $comentario->user_id && auth()->user()->rol !== 0) {
            return back()->with('error', 'No tienes permiso para actualizar este comentario.');
        }

        // Validación del comentario
        $request->validate([
            'comentario' => 'required|string|max:255', // Asegúrate de usar 'comentario' aquí
        ]);

        // Actualizar el comentario
        $comentario->comentario = $request->comentario; // Actualiza el contenido
        $comentario->save();

        // Redirigir de nuevo a la página de la subasta con un mensaje de éxito
        return redirect()->route('subastas.show', $comentario->subasta_id)
                         ->with('success', 'Comentario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);

        // Verificamos si el usuario actual es el dueño del comentario o un administrador (rol 0)
        if ($comentario->user_id !== auth()->id() && auth()->user()->rol !== 0) {
            return redirect()->route('subastas.show', $comentario->subasta_id)
                             ->with('error', 'No tienes permiso para borrar este comentario.');
        }

        // Eliminar el comentario
        $comentario->delete();

        return redirect()->route('subastas.show', $comentario->subasta_id)
                         ->with('success', 'Comentario eliminado con éxito.');
    }
}
