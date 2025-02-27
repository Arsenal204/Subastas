<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;

class PagoController extends Controller
{
    /**
     * Muestra todos los pagos.
     */
    public function index()
    {
        $pagos = Pago::all();
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Muestra el formulario para crear un nuevo pago.
     */
    public function crear()
    {
        return view('pagos.create');
    }

    /**
     * Guarda un nuevo pago en la base de datos.
     */
    public function tienda(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:255'
        ]);

        Pago::create([
            'usuario_id' => $request->usuario_id,
            'monto' => $request->monto,
            'metodo_pago' => $request->metodo_pago,
            'estado' => 'pendiente'
        ]);

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }

    /**
     * Muestra un pago específico.
     */
    public function mostrar($id)
    {
        $pago = Pago::findOrFail($id);
        return view('pagos.show', compact('pago'));
    }

    /**
     * Muestra el formulario de edición de un pago.
     */
    public function editar($id)
    {
        $pago = Pago::findOrFail($id);
        return view('pagos.edit', compact('pago'));
    }

    /**
     * Actualiza un pago en la base de datos.
     */
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,completado,fallido'
        ]);

        $pago = Pago::findOrFail($id);
        $pago->update($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    /**
     * Elimina un pago de la base de datos.
     */
    public function eliminar($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente.');
    }
}

