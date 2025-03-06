@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Mis Subastas</h1>

    @isset($subastas)
        @if($subastas->isEmpty())
            <p>No tienes subastas creadas.</p>
        @else
            <div class="row">
                @foreach($subastas as $subasta)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ optional($subasta->producto)->nombre ?? 'Producto desconocido' }}</h5>
                                <p class="card-text"><strong>Precio Actual:</strong> ${{ number_format($subasta->precio_actual, 2) }}</p>
                                <p class="card-text"><strong>Estado:</strong> {{ ucfirst($subasta->estado) }}</p>
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
