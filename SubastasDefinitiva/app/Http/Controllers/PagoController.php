<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Stripe;

class PagoController extends Controller
{
    public function index()
    {
        return view('pagos.index'); // Vista donde se mostrará el formulario de pago
    }

    public function checkout(Request $request)
    {
        $user = auth()->user(); // Obtiene el usuario autenticado

        try {
            $paymentMethod = $request->input('payment_method');

            // Crea o actualiza el cliente en Stripe
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);

            // Realiza el cobro (por ejemplo, $50.00)
            $user->charge(5000, $paymentMethod);

            return redirect()->route('pagos.exito')->with('success', 'Pago realizado con éxito.');
        } catch (IncompletePayment $exception) {
            return redirect()->route('pagos.fallo')->with('error', 'El pago no se pudo completar.');
        }
    }
}
