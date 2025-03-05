<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subasta;
use App\Models\Puja;
use App\Models\Pago;
use App\Models\Comentario;
use App\Models\Mensaje;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear Usuarios
        $usuarios = User::factory(10)->create();

        // Crear Categorías
        $categorias = Categoria::factory(5)->create();

        // Crear Productos y asociarlos a categorías
        $productos = Producto::factory(20)->create([
            'categoria_id' => $categorias->random()->id
        ]);

        // Crear Subastas y asociarlas a Usuarios
        $subastas = Subasta::factory(10)->create([
            'user_id' => $usuarios->random()->id
        ]);

        // Asociar productos a subastas (Muchos a Muchos)
        foreach ($subastas as $subasta) {
            $productosRandom = $productos->random(rand(1, 3)); // Cada subasta tiene 1-3 productos
            $subasta->productos()->attach($productosRandom);
        }

        // Crear Pujas aleatorias
        Puja::factory(30)->create([
            'subasta_id' => $subastas->random()->id,
            'user_id' => $usuarios->random()->id,
        ]);

        // Crear Pagos aleatorios
        Pago::factory(10)->create([
            'subasta_id' => $subastas->random()->id,
            'user_id' => $usuarios->random()->id,
        ]);

        // Crear Comentarios aleatorios
        Comentario::factory(15)->create([
            'subasta_id' => $subastas->random()->id,
            'user_id' => $usuarios->random()->id,
        ]);

        // Crear Mensajes aleatorios entre usuarios
        Mensaje::factory(20)->create([
            'emisor_id' => $usuarios->random()->id,
            'receptor_id' => $usuarios->random()->id,
        ]);
    }
}

