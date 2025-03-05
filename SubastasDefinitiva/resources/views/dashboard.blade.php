@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <h2 class="mt-4">Subastas Activas</h2>

    @isset($subastas)
        @if($subastas->isEmpty())
            <p>No hay subastas activas en este momento.</p>
        @else
            <div class="row">
                @foreach($subastas as $subasta)
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Productos en Subasta:
                    <ul>
                        @foreach($subasta->productos as $producto)
                            <li>{{ $producto->nombre }}</li>
                        @endforeach
                    </ul>
                </h5>
                <p class="card-text"><strong>Precio Actual:</strong> ${{ number_format($subasta->precio_actual, 2) }}</p>
                <p class="card-text"><strong>Finaliza en:</strong> {{ \Carbon\Carbon::parse($subasta->fecha_fin)->format('d/m/Y H:i') }}</p>
                <a href="{{ route('subastas.show', $subasta->id) }}" class="btn btn-primary">Ver Subasta</a>
            </div>
        </div>
    </div>
@endforeach

            </div>
        @endif
    @else
        <p>Error: No se encontraron subastas.</p>
    @endisset
</div>
@endsection
