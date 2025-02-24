<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subasta;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subasta>
 */
class SubastaFactory extends Factory {
    protected $model = Subasta::class;

    public function definition(): array {
        return [
            'usuario_id' => User::factory(),
            'precio_inicial' => fake()->randomFloat(2, 10, 1000),
            'precio_actual' => fake()->randomFloat(2, 10, 1000),
            'fecha_inicio' => fake()->dateTime(),
            'fecha_fin' => fake()->dateTime(),
            'estado' => fake()->randomElement(['activa', 'cerrada', 'cancelada']),
        ];
    }
}
