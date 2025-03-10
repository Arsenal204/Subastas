@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Subasta</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('subastas.store') }}" method="POST">
        @csrf

        <!-- Selección de Producto -->
        <div class="mb-3">
            <label for="producto_id" class="form-label">Seleccionar Producto</label>
            <select name="producto_id[]" id="producto_id" class="form-control" required>
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_base }}">
                        {{ $producto->nombre }} - ${{ number_format($producto->precio_base, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Precio Inicial -->
        <div class="mb-3">
            <label for="precio_inicial" class="form-label">Precio Inicial</label>
            <input type="number" name="precio_inicial" id="precio_inicial" class="form-control" step="0.01" required>
        </div>

        <!-- Fecha de Inicio (Automática) -->
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required readonly>
        </div>

        <!-- Fecha de Finalización -->
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
            <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control" required>
        </div>

        <div id="error-message" class="text-danger mb-3" style="display: none;">
            El precio inicial debe ser mayor que el precio del producto seleccionado.
        </div>

        <!-- Botón de Envío -->
        <button type="submit" class="btn btn-success">Crear Subasta</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const productoSelect = document.getElementById("producto_id");
        const precioInicialInput = document.getElementById("precio_inicial");
        const errorMessage = document.getElementById("error-message");

        productoSelect.addEventListener("change", function() {
            const selectedOption = productoSelect.options[productoSelect.selectedIndex];
            const precioBase = parseFloat(selectedOption.getAttribute("data-precio")) || 0;

            // Establece el precio mínimo permitido en el campo de entrada
            precioInicialInput.min = precioBase + 0.01;

            // Mostrar mensaje de error si el precio ingresado es menor al permitido
            precioInicialInput.addEventListener("input", function() {
                if (parseFloat(precioInicialInput.value) <= precioBase) {
                    errorMessage.style.display = "block";
                } else {
                    errorMessage.style.display = "none";
                }
            });
        });
    });
</script>
@endsection
