@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Realizar Pago</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('pagos.checkout') }}" method="POST" id="payment-form">
            @csrf
            <div class="form-group">
                <label for="card-holder-name">Nombre en la tarjeta</label>
                <input id="card-holder-name" class="form-control" type="text">
            </div>

            <div class="form-group">
                <label for="card-element">Información de la Tarjeta</label>
                <div id="card-element" class="form-control"></div>
            </div>

            <button type="submit" class="btn btn-primary mt-3" id="card-button" data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}">
                Pagar
            </button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            });

            if (error) {
                alert(error.message);
            } else {
                document.getElementById('payment-form').submit();
            }
        });
    </script>
@endsection
