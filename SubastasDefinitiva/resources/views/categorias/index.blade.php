@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary">Lista de Categorías</h1>

    <!-- Botón para crear una nueva categoría -->
    <div class="text-center my-4">
        <a href="{{ route('categorias.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Crear Nueva Categoría
        </a>
    </div>

    <!-- Tabla de categorías -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                        <tr>
                            <td><strong>{{ $categoria->nombre }}</strong></td>
                            <td>{{ $categoria->descripcion }}</td>
                            <td class="text-center">
                                <!-- Botón Editar -->
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Formulario para Eliminar -->
                                <form action="{{ route('categorias.eliminar', $categoria->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
