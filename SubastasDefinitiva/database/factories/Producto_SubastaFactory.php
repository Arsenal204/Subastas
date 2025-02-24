<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;
use App\Models\Subasta;
use App\Models\Productos_Subasta;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto_Subasta>
 */
class ProductoSubastaFactory extends Factory {
    protected $model = Productos_Subasta::class;

    public function definition(): array {
        return [
            'producto_id' => Producto::factory(),
            'subasta_id' => Subasta::factory(),
        ];
    }
}