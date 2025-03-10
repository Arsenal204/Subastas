@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Subasta</h1>

    <form action="{{ route('subastas.update', $subasta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="precio_inicial" class="form-label">Precio Inicial</label>
            <input type="number" name="precio_inicial" id="precio_inicial" class="form-control" step="0.01" value="{{ $subasta->precio_inicial }}" required>
        </div>
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
            <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $subasta->fecha_fin }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Subasta</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url()->previous() }}'">Cancelar</button>
    </form>
</div>
@endsection
