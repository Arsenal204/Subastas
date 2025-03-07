@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Subasta</h1>

    <form action="{{ route('subastas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="precio_inicial" class="form-label">Precio Inicial</label>
            <input type="number" name="precio_inicial" id="precio_inicial" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
            <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Crear Subasta</button>
    </form>
</div>
@endsection
