<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoSubasta;
use App\Models\Producto;
use App\Models\Productos_Subasta;

class ProductoSubastaController extends Controller
{
    // Mostrar lista de productos en subasta
    public function index()
    {
        $productosSubasta = Productos_Subasta::with('producto')->get();
        return view('productos_subasta.index', compact('productosSubasta'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $productos = Producto::all(); // Listar productos disponibles
        return view('productos_subasta.create', compact('productos'));
    }

    // Guardar un producto en subasta
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'precio_inicial' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        Productos_Subasta::create($request->all());

        return redirect()->route('productos_subasta.index')->with('success', 'Producto añadido a la subasta correctamente.');
    }

    // Mostrar detalles de un producto en subasta
    public function show($id)
    {
        $productoSubasta = Productos_Subasta::with('producto')->findOrFail($id);
        return view('productos_subasta.show', compact('productoSubasta'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $productoSubasta = Productos_Subasta::findOrFail($id);
        $productos = Producto::all();
        return view('productos_subasta.edit', compact('productoSubasta', 'productos'));
    }

    // Actualizar un producto en subasta
    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'precio_inicial' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $productoSubasta = Productos_Subasta::findOrFail($id);
        $productoSubasta->update($request->all());

        return redirect()->route('productos_subasta.index')->with('success', 'Subasta actualizada correctamente.');
    }

    // Eliminar un producto de la subasta
    public function destroy($id)
    {
        Productos_Subasta::findOrFail($id)->delete();
        return redirect()->route('productos_subasta.index')->with('success', 'Producto eliminado de la subasta.');
    }
}
