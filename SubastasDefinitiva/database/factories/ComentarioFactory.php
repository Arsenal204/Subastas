<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Subasta;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory {
    protected $model = Comentario::class;

    public function definition(): array {
        return [
            'usuario_id' => User::factory(),
            'subasta_id' => Subasta::factory(),
            'comentario' => fake()->text(),
            'valoracion' => fake()->numberBetween(1, 5),
            'moderado' => fake()->boolean(),
        ];
    }
}
