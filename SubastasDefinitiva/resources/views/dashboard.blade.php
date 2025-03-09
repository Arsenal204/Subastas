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
                                <p class="card-text"><strong>Precio Actual:</strong> ${{ number_format($subasta->precio_actual, 2) }}</p>
                                <p class="card-text"><strong>Finaliza en:</strong> {{ \Carbon\Carbon::parse($subasta->fecha_fin)->format('d/m/Y H:i') }}</p>
                                @if($subasta->estado !== 'cancelada')
                                <form action="{{ route('subastas.cancelar', $subasta->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas cancelar esta subasta?')">Cancelar</button>
                                </form>
                                @else
                                    <button class="btn btn-secondary" disabled>Subasta Cancelada</button>
                                @endif
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
