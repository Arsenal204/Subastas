<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Stripe;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Verifica que el usuario esté autenticado
    }

    public function index()
    {
        return view('pagos.index');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user(); // Obtener el usuario autenticado

        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar el pago.');
        }

        try {
            $paymentMethod = $request->input('payment_method');

            // Crea un cliente en Stripe si aún no existe
            if (!$user->hasStripeId()) {
                $user->createAsStripeCustomer();
            }

            // Actualiza el método de pago
            $user->updateDefaultPaymentMethod($paymentMethod);

            // Cobrar al usuario ($50.00 en centavos = 5000)
            $user->charge(5000, $paymentMethod);

            return redirect()->route('pagos.exito')->with('success', 'Pago realizado con éxito.');
        } catch (IncompletePayment $exception) {
            return redirect()->route('pagos.fallo')->with('error', 'El pago no se pudo completar.');
        }
    }
}
