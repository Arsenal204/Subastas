@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Categoría</h1>

        <form action="{{ route('categorias.tienda') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">Guardar Categoría</button>
        </form>
    </div>
@endsection
