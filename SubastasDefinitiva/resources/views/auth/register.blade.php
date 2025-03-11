<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <div class="flex items-center justify-center mt-4">
    <a href="{{ url('auth/github') }}" 
       class="flex items-center px-4 py-2 bg-gray-900 text-white rounded-md shadow-md hover:bg-gray-700 transition">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" 
                d="M12 2C6.477 2 2 6.478 2 12c0 4.418 2.865 8.167 6.839 9.49.5.092.683-.217.683-.482 0-.237-.009-.868-.014-1.703-2.782.603-3.369-1.34-3.369-1.34-.455-1.156-1.11-1.464-1.11-1.464-.907-.62.069-.608.069-.608 1.003.071 1.53 1.031 1.53 1.031.892 1.528 2.34 1.087 2.91.831.092-.647.35-1.087.636-1.337-2.221-.253-4.555-1.113-4.555-4.953 0-1.093.39-1.987 1.03-2.685-.103-.254-.447-1.27.097-2.646 0 0 .84-.269 2.75 1.025a9.563 9.563 0 012.5-.336c.85.004 1.705.115 2.5.336 1.91-1.294 2.75-1.025 2.75-1.025.544 1.376.2 2.392.097 2.646.64.698 1.03 1.592 1.03 2.685 0 3.851-2.337 4.697-4.566 4.945.36.31.68.921.68 1.857 0 1.34-.012 2.422-.012 2.75 0 .267.18.578.688.48A10.01 10.01 0 0022 12c0-5.522-4.477-10-10-10z">
            </path>
        </svg>
        Registrarse con GitHub
    </a>
</div>    
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
