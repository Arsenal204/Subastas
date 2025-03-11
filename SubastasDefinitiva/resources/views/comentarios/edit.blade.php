@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Comentario</h1>

    <!-- Formulario para editar comentario -->
    <form action="{{ route('comentarios.update', $comentario->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="comentario">Comentario:</label>
            <textarea name="comentario" id="comentario" class="form-control" rows="3">{{ old('comentario', $comentario->comentario) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Comentario</button>
    </form>
</div>
@endsection
