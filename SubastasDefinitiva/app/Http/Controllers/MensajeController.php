<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensajeController extends Controller
{
    // Mostrar la conversación del chat
    public function index()
    {
        // Obtener todos los usuarios excepto el usuario autenticado
        $usuarios = User::where('id', '!=', Auth::id())->get();

        // Obtener todos los mensajes entre los dos usuarios
        $messages = Mensaje::where(function ($query) {
            $query->where('emisor_id', Auth::id())
                  ->where('receptor_id', request()->query('user_id'));
        })
        ->orWhere(function ($query) {
            $query->where('emisor_id', request()->query('user_id'))
                  ->where('receptor_id', Auth::id());
        })
        ->get();

        return view('chat.index', compact('messages', 'usuarios'));
    }

    // Enviar un mensaje
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Guardar el mensaje
        Mensaje::create([
            'emisor_id' => Auth::id(),
            'receptor_id' => $request->to_user_id,
            'mensaje' => $request->message,
        ]);

        return redirect()->route('chat.index', ['user_id' => $request->to_user_id]);
    }
}
