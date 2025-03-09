<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-white leading-tight">
            {{ $producto->nombre }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    
                    <!-- Imagen del Producto -->
                    <div class="relative">
                        <img src="{{ $producto->imagen_url ?? 'https://via.placeholder.com/600x400' }}" 
                             alt="{{ $producto->nombre }}" 
                             class="w-full h-96 object-cover">
                    </div>

                    <!-- Información del Producto -->
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ $producto->nombre }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">
                            {{ $producto->descripcion }}
                        </p>

                        <div class="mt-4">
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">
                                Precio Inicial: <span class="text-green-500">${{ number_format($producto->precio_inicial, 2) }}</span>
                            </p>
                            @if($producto->subasta)
                                <p class="text-lg font-semibold text-gray-800 dark:text-white">
                                    Oferta Actual: <span class="text-blue-500">${{ number_format($producto->subasta->oferta_actual, 2) }}</span>
                                </p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                    Finaliza el {{ $producto->subasta->fecha_fin->format('d M, Y H:i') }}
                                </p>
                            @else
                                <p class="text-red-500 text-sm">Este producto no está en subasta actualmente.</p>
                            @endif
                        </div>

                        <!-- Botón para ofertar si la subasta está activa -->
                        @if($producto->subasta && now() < $producto->subasta->fecha_fin)
                            <form action="{{ route('subastas.pujar', $producto->subasta->id) }}" method="POST" class="mt-4">
                                @csrf
                                <label class="block text-gray-800 dark:text-white">Ingrese su oferta:</label>
                                <input type="number" name="monto" step="0.01" min="{{ $producto->subasta->oferta_actual + 1 }}" 
                                       class="w-full mt-1 p-2 border rounded-lg dark:bg-gray-700 dark:text-white">
                                <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg">
                                    Hacer Oferta
                                </button>
                            </form>
                        @else
                            <p class="text-gray-500 mt-3">La subasta ha finalizado o no está disponible.</p>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Sección de Comentarios -->
            <div class="mt-8 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Comentarios</h3>
                
                @if($producto->comentarios->isEmpty())
                    <p class="text-gray-500 dark:text-gray-300">No hay comentarios aún.</p>
                @else
                    <ul class="divide-y divide-gray-300 dark:divide-gray-600">
                        @foreach ($producto->comentarios as $comentario)
                            <li class="py-4">
                                <p class="text-gray-900 dark:text-white font-semibold">
                                    {{ $comentario->usuario->name }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $comentario->contenido }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $comentario->created_at->diffForHumans() }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Agregar un comentario -->
                @auth
                    <form action="{{ route('comentarios.store', $producto->id) }}" method="POST" class="mt-4">
                        @csrf
                        <label class="block text-gray-800 dark:text-white">Escribe un comentario:</label>
                        <textarea name="contenido" rows="3" class="w-full mt-1 p-2 border rounded-lg dark:bg-gray-700 dark:text-white"></textarea>
                        <button type="submit" class="mt-3 px-4 py-2 bg-green-600 text-white rounded-lg">
                            Comentar
                        </button>
                    </form>
                @else
                    <p class="text-gray-500 mt-3">Inicia sesión para comentar.</p>
                @endauth
            </div>

        </div>
    </div>
</x-app-layout>

