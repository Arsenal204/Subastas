<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Puja;
use App\Models\Subasta;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Puja>
 */
class PujaFactory extends Factory {
    protected $model = Puja::class;

    public function definition(): array {
        return [
            'subasta_id' => Subasta::factory(),
            'usuario_id' => User::factory(),
            'monto' => fake()->randomFloat(2, 10, 5000),
            'es_ganadora' => false,
            'autopuja' => fake()->boolean(),
        ];
    }
}
