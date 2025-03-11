@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Categoría</h1>

        <form action="{{ route('categorias.actualizar', $categoria->id) }}" method="POST" class="bg-white p-4 shadow rounded-3">
            @csrf
            @method('PUT')
            
            <!-- Campo de Nombre -->
            <div class="form-group mb-4">
                <label for="nombre" class="form-label fw-bold">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}" class="form-control border-2 rounded-2" required>
                @error('nombre')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo de Descripción -->
            <div class="form-group mb-4">
                <label for="descripcion" class="form-label fw-bold">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control border-2 rounded-2" rows="4">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botón de Actualizar -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-warning fw-bold px-4 py-2">
                    <i class="fas fa-edit me-2"></i> Actualizar Categoría
                </button>
            </div>
        </form>
    </div>
@endsection
