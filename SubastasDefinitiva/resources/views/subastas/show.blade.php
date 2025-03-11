@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Subasta</h1>

    <div class="card">
        <div class="card-body">

            <!-- Información de la Subasta -->
            <p><strong>Estado:</strong> {{ ucfirst($subasta->estado) }}</p>
            <p><strong>Precio Inicial:</strong> ${{ number_format($subasta->precio_inicial, 2) }}</p>
            <p><strong>Precio Actual:</strong> ${{ number_format($subasta->precio_actual, 2) }}</p>
            <p><strong>Finaliza el:</strong> {{ \Carbon\Carbon::parse($subasta->fecha_fin)->format('d/m/Y H:i') }}</p>

            <!-- Productos en la Subasta -->
            @if($subasta->productos->isNotEmpty())
                <h5>Productos en esta subasta:</h5>
                <ul>
                    @foreach($subasta->productos as $producto)
                        <li>
                            {{ $producto->nombre }} 
                            <button class="btn btn-primary" onclick="window.location.href='{{ route('productos.show', $producto->id) }}'">
                                Ver Detalles
                            </button>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No hay productos asociados.</p>
            @endif

            <!-- Solo el creador puede editar la subasta -->
            @if($subasta->user_id === auth()->id())
                <a href="{{ route('subastas.edit', $subasta->id) }}" class="btn btn-primary">Editar Subasta</a>
            @endif

            <!-- Formulario de Puja -->
            @auth
                @if($subasta->user_id !== auth()->id()) 
                    <div class="mt-4 p-3 border rounded">
                        <h5>Pujar en esta subasta</h5>

                        <!-- Mostrar mensajes de éxito o error -->
                        @if(session('success'))
                            <p class="text-success">{{ session('success') }}</p>
                        @endif

                        @if(session('error'))
                            <p class="text-danger">{{ session('error') }}</p>
                        @endif

                        <form action="{{ route('subastas.pujar', $subasta->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto a Pujar:</label>
                                <input 
                                    type="number" 
                                    name="monto" 
                                    class="form-control" 
                                    step="0.01" 
                                    min="{{ $subasta->precio_actual + 1 }}" 
                                    required>
                            </div>
                            <button type="submit" class="btn btn-success">Pujar</button>
                        </form>
                    </div>
                @else
                    <p class="text-info mt-3">No puedes pujar en tu propia subasta.</p>
                @endif
            @else
                <p class="text-danger mt-3">Debes <a href="{{ route('login') }}">iniciar sesión</a> para pujar.</p>
            @endauth

            <!-- Botón de Cancelar -->
            <button type="button" class="btn btn-secondary mt-3" onclick="window.location.href='{{ url()->previous() }}'">
                Volver
            </button>

        </div>
    </div>
</div>
@endsection
