<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory {
    protected $model = Categoria::class;

    public function definition(): array {
        return [
            'nombre' => fake()->word(),
            'descripcion' => fake()->sentence(),
            'imagen_url' => fake()->imageUrl(),
            'activo' => fake()->boolean(),
            'orden' => fake()->numberBetween(1, 100),
        ];
    }
}
