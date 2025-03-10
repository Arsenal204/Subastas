<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
<<<<<<< HEAD
            
            <!-- Información del usuario -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Información Personal</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2"><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
                <p class="text-gray-600 dark:text-gray-300"><strong>Email:</strong> {{ auth()->user()->email }}</p>
            </div>

            <!-- Formulario para actualizar la información del usuario -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Actualizar Perfil</h3>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Formulario para cambiar la contraseña -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cambiar Contraseña</h3>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Sección de Subastas Activas -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Subastas Activas</h3>

                @if(isset($subastasActivas) && $subastasActivas->count() > 0)
                    <ul class="mt-4 space-y-3">
                        @foreach($subastasActivas as $subasta)
                            <li class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">{{ $subasta->nombre }}</h4>
                                <p class="text-gray-600 dark:text-gray-300">Finaliza el: {{ $subasta->fecha_fin }}</p>
                                <a href="{{ route('subastas.show', $subasta->id) }}" class="text-blue-500 hover:text-blue-700">Ver detalles</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600 dark:text-gray-300 mt-2">No tienes subastas activas en este momento.</p>
                @endif
            </div>

            <!-- Botón para eliminar cuenta -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-red-600">Eliminar Cuenta</h3>
                @include('profile.partials.delete-user-form')
            </div>
=======

            <!-- Tarjeta de Información del Usuario -->
            @auth
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg flex flex-col items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=128"
                        alt="Avatar de usuario"
                        class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-md">
                    <h3 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                        {{ auth()->user()->name }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ auth()->user()->email }}</p>
                    <p class="mt-2 text-gray-500 text-sm dark:text-gray-300">
                        Miembro desde {{ auth()->user()->created_at->format('d M, Y') }}
                    </p>
                </div>

                <!-- Sección de Subastas Activas -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Mis Subastas Activas</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        Aquí puedes ver las subastas en las que estás participando o has creado.
                    </p>

                    @php
                        $subastasActivas = auth()->user()->subastas()->where('estado', 'activa')->get();
                    @endphp
>>>>>>> 70a6317d9699962ecad11a55e3689ccc4a5bc132

                    @if ($subastasActivas->isEmpty())
                        <p class="text-gray-500 dark:text-gray-300">No tienes subastas activas en este momento.</p>
                    @else
                        <ul class="divide-y divide-gray-300 dark:divide-gray-600">
                            @foreach ($subastasActivas as $subasta)
                                <li class="py-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                                            Finaliza el {{ $subasta->fecha_fin }}
                                        </p>
                                    </div>
                                    <a href="{{ route('subastas.show', $subasta->id) }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm">
                                        Ver Subasta
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @else
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                    <p class="text-gray-500 dark:text-gray-300">Debes iniciar sesión para ver tu perfil.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>
