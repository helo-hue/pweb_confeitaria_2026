<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReceitaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->randomElement([
                'Produto de Chocolate',
                'Produto de Cenoura',
                'Produto Red Velvet',
                'Produto de Morango',
                'Produto de Baunilha'
            ]),

            'ingredientes' => $this->faker->sentence(10),

            'modo_preparo' => $this->faker->paragraph(),

            'tempo_preparo' => $this->faker->numberBetween(30, 120),

            'rendimento' => $this->faker->numberBetween(5, 20)
        ];
    }
}
