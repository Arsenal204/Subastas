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
    public function dashboard()
    {
        $subastas = Subasta::where('estado', 'activa')
            ->where('fecha_inicio', '<=', Carbon::now())
            ->where('fecha_fin', '>=', Carbon::now())
            ->get();

        return view('dashboard', compact('subastas'));
    }

    public function vendedorDashboard()
    {
        $usuario = Auth::user();
        $subastas = Subasta::where('user_id', $usuario->id)->get();

        return view('vendedor', compact('subastas'));
    }

    public function adminSubastas()
    {
        $subastas = Subasta::all();
        return view('admin', compact('subastas'));
    }


    public function create()
    {
        $productos = Producto::all(); // Obtener todos los productos
        return view('subastas.create', compact('productos'));
    }


    // Guardar subasta en la base de datos
    public function store(Request $request)
{
    // Validación básica de los datos recibidos
    $request->validate([
        'producto_id' => 'required|array|min:1', // Asegurando que sea un arreglo de productos
        'producto_id.*' => 'exists:productos,id', // Validación individual para cada producto
        'precio_inicial' => 'required|numeric|min:0',
        'fecha_inicio' => 'required|date|after_or_equal:today',
        'fecha_fin' => 'required|date|after:fecha_inicio',
    ]);

    // Verifica que hay un usuario autenticado antes de usar su ID
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para crear una subasta.');
    }

    // Asegurarse que la fecha de inicio sea hoy
    $fecha_inicio = Carbon::today();

    // Asegurarse que la fecha de fin sea al menos un día después de la fecha de inicio
    $fecha_fin = Carbon::parse($request->fecha_fin);
    if ($fecha_fin->lessThan($fecha_inicio->addDay())) {
        return back()->with('error', 'La fecha de fin debe ser al menos un día después de la fecha de inicio.');
    }

    // Obtener los productos seleccionados y calcular el precio total
    $productos = Producto::whereIn('id', $request->producto_id)->get();
    $precio_total_producto = $productos->sum('precio_base'); // Usamos 'precio_base' de cada producto

    // Validar que el precio inicial sea mayor que la suma de los productos
    if ($request->precio_inicial <= $precio_total_producto) {
        return back()->with('error', 'El precio inicial debe ser mayor que la suma de los productos en la subasta.');
    }

    // Crear la subasta
    $subasta = new Subasta();
    $subasta->user_id = Auth::id();
    $subasta->precio_inicial = $request->precio_inicial;
    $subasta->precio_actual = $request->precio_inicial;
    $subasta->fecha_inicio = $fecha_inicio; // Se asigna la fecha de inicio hoy
    $subasta->fecha_fin = $fecha_fin;
    $subasta->estado = 'activa';
    $subasta->save();

    // Asociar los productos con la subasta en la tabla pivote
    $subasta->productos()->attach($request->producto_id);

    return redirect()->back()->with('success', 'Subasta creada correctamente.');
}

    // Mostrar formulario de edición
    public function edit($id)
{
    $subasta = Subasta::findOrFail($id);
    return view('subastas.edit', compact('subasta'));
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
