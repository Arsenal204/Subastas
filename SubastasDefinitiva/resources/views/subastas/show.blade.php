@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Subasta</h1>

    <div class="card">
        <div class="card-body">

            <p><strong>Estado:</strong> {{ ucfirst($subasta->estado) }}</p>
            <p><strong>Precio Inicial:</strong> ${{ number_format($subasta->precio_inicial, 2) }}</p>
            <p><strong>Precio Actual:</strong> ${{ number_format($subasta->precio_actual, 2) }}</p>

            <p><strong>Finaliza el:</strong>
                {{ \Carbon\Carbon::parse($subasta->fecha_fin)->format('d/m/Y H:i') }}
            </p>

            @if($subasta->productos->isNotEmpty())
                <h5>Productos en esta subasta:</h5>
                <ul>
                    @foreach($subasta->productos as $producto)
                        <li>{{ $producto->nombre }} <button class="btn btn-primary" onclick="window.location.href='{{ route('productos.show', $producto->id) }}'">Ver Detalles</button></li>
                    @endforeach
                </ul>
            @else
                <p>No hay productos asociados.</p>
            @endif

            @if($subasta->user_id === auth()->id())
                <a href="{{ route('subastas.edit', $subasta->id) }}" class="btn btn-primary">Editar Subasta</a>
            @endif
        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url()->previous() }}'">Cancelar</button>
        </div>
    </div>
</div>
@endsection
