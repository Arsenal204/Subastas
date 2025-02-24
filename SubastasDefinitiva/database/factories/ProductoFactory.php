<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;
use App\Models\Categoria;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory {
    protected $model = Producto::class;
    

    public function definition(): array {
        return [
            'nombre' => fake()->word(),
            'descripcion' => fake()->paragraph(),
            'precio_base' => fake()->randomFloat(2, 10, 1000),
            'estado' => fake()->randomElement(['nuevo', 'usado', 'reacondicionado']),
            'stock' => fake()->numberBetween(1, 50),
            'categoria_id' => Categoria::factory(),
        ];
    }
}
