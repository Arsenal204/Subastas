@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados de la búsqueda</h1>
        
        @if($productos->isEmpty())
            <p>No se encontraron productos para la categoría buscada.</p>
        @else
            <div class="row">
                @foreach($productos as $producto)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text">{{ $producto->descripcion }}</p>
                                <p class="card-text">Precio: ${{ $producto->precio_base }}</p>
                                <p class="card-text">Estado: {{ $producto->estado }}</p>
                                <p class="card-text">Stock: {{ $producto->stock }}</p>
                                <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary">Ver producto</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
