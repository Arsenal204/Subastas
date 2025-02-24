<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mensaje;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mensaje>
 */
class MensajeFactory extends Factory {
    protected $model = Mensaje::class;

    public function definition(): array {
        return [
            'emisor_id' => User::factory(),
            'receptor_id' => User::factory(),
            'mensaje' => fake()->sentence(),
            'leido' => fake()->boolean(),
            'tipo' => fake()->randomElement(['texto', 'imagen', 'archivo']),
        ];
    }
}
