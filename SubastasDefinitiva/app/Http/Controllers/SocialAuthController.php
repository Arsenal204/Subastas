<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    /**
     * Redirige al usuario a GitHub para la autenticación.
     */
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }
    

    /**
     * Maneja la respuesta de GitHub y crea un usuario o lo actualiza.
     */
    public function handleGitHubCallback()
    {
        try {
            // Obtiene la información del usuario desde GitHub
            $githubUser = Socialite::driver('github')->user();

            // Si el nombre está vacío, utiliza el nickname o el email como fallback
            $name = $githubUser->getName() ?: $githubUser->getNickname() ?: $githubUser->getEmail();

            // Busca al usuario en la base de datos o lo crea si no existe
            $user = User::updateOrCreate(
                ['email' => $githubUser->getEmail()],
                [
                    'name' => $name,
                    'email' => $githubUser->getEmail(),
                    'github_id' => $githubUser->getId(),
                    'avatar' => $githubUser->getAvatar(),
                    'password' => bcrypt(uniqid()) // Genera una contraseña aleatoria
                ]
            );

            // Autentica al usuario en la sesión
            Auth::login($user);

            // Redirige a la página principal del dashboard o la ruta deseada
            return redirect()->route('dashboard'); // Asegúrate de que 'dashboard' esté definida como una ruta

        } catch (\Exception $e) {
            // Si algo sale mal, redirige a la página de login con un mensaje de error
            return redirect('/login')->with('error', 'Error en la autenticación con GitHub: ' . $e->getMessage());
        }
    }
}