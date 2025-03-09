@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Producto</h1>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $producto->nombre }}</h2>
            <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
            <p><strong>Precio Base:</strong> ${{ number_format($producto->precio_base, 2) }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($producto->estado) }}</p>
            <p><strong>Stock Disponible:</strong> {{ $producto->stock }}</p>

            @if($producto->categoria)
                <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
            @else
                <p><strong>Categoría:</strong> No especificada</p>
            @endif

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection
