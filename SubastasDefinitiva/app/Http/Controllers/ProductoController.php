<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    // Mostrar lista de productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('productos.create');
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
