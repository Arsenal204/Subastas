<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Subasta;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\User;



class SubastaController extends Controller
{
    public function dashboard() {
        $subastas = Subasta::where('estado', 'activa')
            ->where('fecha_inicio', '<=', Carbon::now())
            ->where('fecha_fin', '>=', Carbon::now())
            ->get();

        return view('dashboard', compact('subastas'));
    }

    public function vendedorDashboard() {
        $usuario = Auth::user();
        $subastas = Subasta::where('user_id', $usuario->id)->get();

        return view('vendedor', compact('subastas'));
    }

public function adminSubastas() {
    $subastas = Subasta::all();
    return view('admin', compact('subastas'));
}


public function create()
    {
        $productos = Producto::all();
        return view('subastas.create', compact('productos'));
    }

    // Guardar subasta en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'precio_inicial' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        // Verifica que hay un usuario autenticado antes de usar su ID
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para crear una subasta.');
        }

        // Asignar el usuario autenticado a la subasta
        $subasta = new Subasta();
        $subasta->producto_id = $request->producto_id;
        $subasta->usuario_id = Auth::id(); // Aquí usamos Auth::id() en vez de auth()->id()
        $subasta->precio_inicial = $request->precio_inicial;
        $subasta->precio_actual = $request->precio_inicial;
        $subasta->fecha_inicio = $request->fecha_inicio;
        $subasta->fecha_fin = $request->fecha_fin;
        $subasta->estado = 'activa';
        $subasta->save();

        return redirect()->back()->with('success', 'Subasta creada correctamente.');
    }



    // Mostrar formulario de edición
    public function edit(Subasta $subasta)
    {
        $productos = Producto::all();
        return view('subastas.edit', compact('subasta', 'productos'));
    }

    // Actualizar subasta en la base de datos
    public function update(Request $request, Subasta $subasta)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'precio_inicial' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $subasta->update([
            'producto_id' => $request->producto_id,
            'precio_inicial' => $request->precio_inicial,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->back()->with('success', 'Subasta actualizada correctamente.');
    }
    public function show($id)
{
    $subasta = Subasta::with(['productos', 'user'])->findOrFail($id);

    return view('subastas.show', compact('subasta'));
}

public function cancelar($id)
{
    $subasta = Subasta::findOrFail($id);
    $subasta->estado = 'cancelada';
    $subasta->save();

    return redirect()->back()->with('success', 'Subasta cancelada correctamente.');
}


}



