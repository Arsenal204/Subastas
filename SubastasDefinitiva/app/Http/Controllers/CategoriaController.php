<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class CategoriaController extends Controller
{
    /**
     * Muestra la lista de categorías.
     */
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all(); 
        return view('categorias.index', compact('categorias')); 
    }

    /**
     * Muestra los productos de una categoría.
     */
    public function mostrarProductos($id)
    {
        // Obtener los productos relacionados con la categoría
        $productos = Producto::where('categoria_id', $id)->get(); 
        return view('categorias.productos', compact('productos')); 
    }

    /**
     * Muestra una categoría específica.
     */
    public function mostrar($id)
    {
        // Buscar la categoría específica por ID
        $categoria = Categoria::findOrFail($id); 
        return view('categorias.show', compact('categoria')); 
    }

    /**
     * Muestra el formulario para crear una categoría.
     */
    public function crear()
    {
        return view('categorias.create'); 
    }
    

    /**
     * Guarda una nueva categoría en la base de datos.
     */
    public function tienda(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);
    
        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
    
        return redirect()->route('categorias.index'); 
    }
    

    /**
     * Muestra el formulario para editar una categoría.
     */
    public function edit($id)
    {
        // Buscar la categoría por ID
        $categoria = Categoria::findOrFail($id); 
        return view('categorias.edit', compact('categoria')); 
    }

    /**
     * Actualiza una categoría en la base de datos.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string'
    ]);

    $categoria = Categoria::findOrFail($id);
    $categoria->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion
    ]);

    return redirect()->route('categorias.index');
}

    



    /**
     * Elimina una categoría de la base de datos.
     */
    public function destroy($id)
    {
        // Buscar y eliminar la categoría
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        // Redirigir a la vista de categorías
        return redirect()->route('categorias.index'); 
    }

    /**
     * Buscar categorías o productos por nombre.
     */
    public function buscarPorCategoria(Request $request)
    {
        // Validar el término de búsqueda
        $request->validate([
            'category' => 'nullable|string|max:255',
        ]);
    
        // Si se pasa un término de búsqueda
        if ($request->has('category') && $request->category) {
            // Filtrar productos por nombre de categoría
            $productos = Producto::whereHas('categoria', function ($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->category . '%');
            })->get();
        } else {
            // Si no hay término de búsqueda, devolver todos los productos
            $productos = Producto::all();
        }
    
        // Retornar los productos encontrados
        return view('productos.buscar', compact('productos'));
    }
}
