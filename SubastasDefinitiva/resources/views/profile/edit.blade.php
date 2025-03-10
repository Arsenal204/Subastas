<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Información del usuario -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Información Personal</h3>

                @if(auth()->check())  
                    <p class="text-gray-600 dark:text-gray-300 mt-2"><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                @else
                    <p class="text-red-500">No estás autenticado.</p>
                @endif
            </div>

            <!-- Sección de Subastas Activas -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Subastas Activas</h3>

                @if(isset($subastasActivas) && $subastasActivas->count() > 0)
                    <ul class="mt-4 space-y-3">
                        @foreach($subastasActivas as $subasta)
                            <li class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">{{ $subasta->nombre }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">Finaliza el: {{ \Carbon\Carbon::parse($subasta->fecha_fin)->format('d/m/Y') }}</p>
                                <a href="{{ route('subastas.show', $subasta->id) }}" class="text-blue-500 hover:text-blue-700">Ver detalles</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600 dark:text-gray-300 mt-2">No tienes subastas activas en este momento.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
