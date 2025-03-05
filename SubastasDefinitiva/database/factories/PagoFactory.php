<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Pago;
use App\Models\Subasta;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pago>
 */
class PagoFactory extends Factory {
    protected $model = Pago::class;

    public function definition(): array {
        return [
            'user_id' => User::factory(),
            'subasta_id' => Subasta::factory(),
            'monto' => fake()->randomFloat(2, 10, 5000),
            'estado' => fake()->randomElement(['pendiente', 'completado', 'fallido']),
            'metodo_pago' => fake()->randomElement(['tarjeta', 'paypal', 'transferencia']),
            'transaccion_id' => Str::uuid(),
        ];
    }
}
