<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-white leading-tight">
            {{ __('Perfil de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Tarjeta de Información del Usuario -->
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

            <!-- Actualizar Información -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Actualizar Información</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Modifica tu información personal aquí.</p>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Cambiar Contraseña -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Cambiar Contraseña</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Por seguridad, cambia tu contraseña regularmente.</p>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Sección de Subastas Activas -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Mis Subastas Activas</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Aquí puedes ver las subastas en las que estás participando o has creado.</p>

                @if ($subastasActivas->isEmpty())
                    <p class="text-gray-500 dark:text-gray-300">No tienes subastas activas en este momento.</p>
                @else
                    <ul class="divide-y divide-gray-300 dark:divide-gray-600">
                        @foreach ($subastasActivas as $subasta)
                            <li class="py-4 flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $subasta->producto->nombre }}
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        Finaliza el {{ $subasta->fecha_fin->format('d M, Y H:i') }}
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

            <!-- Eliminar Cuenta -->
            <div class="p-6 bg-red-100 dark:bg-red-800 shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-red-700 dark:text-red-200">Eliminar Cuenta</h3>
                <p class="text-red-600 dark:text-red-300 text-sm mb-4">
                    Esta acción no se puede deshacer. Se eliminarán todos tus datos de la plataforma.
                </p>
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
