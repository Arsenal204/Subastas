<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subasta;

class Controller
{
    /**
     * Muestra la lista de subastas.
     */
    public function index()
    {
        $subastas = Subasta::all();
        return view('subastas.index', compact('subastas'));
    }

    /**
     * Muestra el formulario para crear una nueva subasta.
     */
    public function crear()
    {
        return view('subastas.create');
    }

    /**
     * Guarda una nueva subasta en la base de datos.
     */
    public function tienda(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_inicial' => 'required|numeric|min:0'
        ]);

        Subasta::crear([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio_inicial' => $request->precio_inicial
        ]);

        return redirect()->route('subastas.index')->with('success', 'Subasta creada correctamente.');
    }

    /**
     * Muestra una subasta específica.
     */
    public function mostrar($id)
    {
        $subasta = Subasta::findOrFail($id);
        return view('subastas.show', compact('subasta'));
    }

    /**
     * Muestra el formulario de edición de una subasta.
     */
    public function editar($id)
    {
        $subasta = Subasta::findOrFail($id);
        return view('subastas.edit', compact('subasta'));
    }

    /**
     * Actualiza una subasta en la base de datos.
     */
    public function modificar(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_inicial' => 'required|numeric|min:0'
        ]);

        $subasta = Subasta::findOrFail($id);
        $subasta->modificar($request->all());

        return redirect()->route('subastas.index')->with('success', 'Subasta actualizada correctamente.');
    }

    /**
     * Elimina una subasta de la base de datos.
     */
    public function borrar($id)
    {
        $subasta = Subasta::findOrFail($id);
        $subasta->delete();

        return redirect()->route('subastas.index')->with('success', 'Subasta eliminada correctamente.');
    }
}