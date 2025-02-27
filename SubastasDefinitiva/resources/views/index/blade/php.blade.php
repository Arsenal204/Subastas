@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Pagos</h2>
    <a href="{{ route('pagos.create') }}" class="btn btn-primary">Nuevo Pago</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Monto</th>
                <th>Método de Pago</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago->usuario->nombre }}</td>
                <td>${{ $pago->monto }}</td>
                <td>{{ $pago->metodo_pago }}</td>
                <td>{{ ucfirst($pago->estado) }}</td>
                <td>
                    <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar pago?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
