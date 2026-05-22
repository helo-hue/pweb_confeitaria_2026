<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->word() . ' Especial',
            'sabor_massa' => $this->faker->randomElement(['Baunilha','Chocolate','Red Velvet']),
            'recheio' => $this->faker->randomElement(['Brigadeiro','Beijinho','Creme de Morango']),
            'cobertura' => $this->faker->randomElement(['Chocolate','Chantilly','Ganache']),
            'valor' => $this->faker->randomFloat(2, 20, 200),
            'imagem' => null 
        ];
    }
}