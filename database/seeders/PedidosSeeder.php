<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;

class PedidosSeeder extends Seeder
{
    public function run(): void
    {
        // Cria 10 pedidos fake
        Pedido::factory()->count(10)->create();
    }
}