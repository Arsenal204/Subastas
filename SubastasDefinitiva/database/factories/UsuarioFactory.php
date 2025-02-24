<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array {
        return [
            'nombre' => fake()->name(),
            'correo' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'rol' => fake()->randomElement(['comprador', 'vendedor', 'admin']),
            'saldo' => fake()->randomFloat(2, 0, 5000),
        ];
    }
}
