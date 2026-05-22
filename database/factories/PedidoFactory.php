<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition()
    {
        $data_pedido = $this->faker->dateTimeBetween('-1 month', 'now');
        $quantidade = $this->faker->randomFloat(2, 0.5, 5); // kg
        $valor_produto = $this->faker->randomFloat(2, 20, 200);
        $valor_total = $quantidade * $valor_produto;

        $formas_pagamento = ['dinheiro', 'cartão', 'pix'];
        $status_possiveis = ['pendente', 'pago', 'entregue'];

        return [
            'cliente_id' => Cliente::factory(),
            'produto_id' => Produto::factory(),
            'quantidade' => $quantidade,
            'valor_total' => $valor_total,
            'data_pedido' => $data_pedido,
            'data_entrega' => $this->faker->dateTimeBetween($data_pedido, '+1 week'),
            'forma_pagamento' => $this->faker->randomElement($formas_pagamento),
            'status' => $this->faker->randomElement($status_possiveis),
        ];
    }
    
    
}