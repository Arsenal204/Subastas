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

    <!-- Sección de comentarios -->
    <div class="mt-4">
        <h3>Comentarios</h3>

        <!-- Mostrar comentarios existentes -->
        @foreach($subasta->comentarios ?? collect() as $comentario)
        <div class="card mt-2">
            <div class="card-body">
                @if($comentario->user)
                    <p><strong>{{ $comentario->user->name }}</strong> comentó:</p>
                @else
                    <p><strong>Usuario desconocido</strong> comentó:</p>
                @endif
                <p>{{ $comentario->comentario }}</p>
                <small class="text-muted">{{ $comentario->created_at->diffForHumans() }}</small>

                <!-- Mostrar el botón de eliminar solo si el usuario es el dueño del comentario o un administrador -->
                @if(auth()->id() === $comentario->user_id || auth()->user()->rol === 0)
                    <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                @endif

                <!-- Mostrar el botón de editar solo si el usuario es el dueño del comentario o un administrador -->
                @if(auth()->id() === $comentario->user_id || auth()->user()->rol === 0)
                    <a href="{{ route('comentarios.edit', $comentario->id) }}" class="btn btn-warning btn-sm mt-2">Editar</a>
                @endif
            </div>
        </div>
        @endforeach

        <!-- Formulario para añadir un comentario -->
        @auth
        <form action="{{ route('comentarios.store', ['id' => $subasta->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="comentario">Comentario:</label>
                <textarea name="comentario" id="comentario" class="form-control" rows="3"></textarea>
            </div>

            <!-- Campo para la valoración -->
            <div class="form-group mt-3">
                <label for="valoracion">Valoración:</label>
                <select name="valoracion" id="valoracion" class="form-control">
                    <option value="1">1 - Muy malo</option>
                    <option value="2">2 - Malo</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bueno</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enviar Comentario</button>
        </form>
        @endauth

    </div>
</div>
@endsection
