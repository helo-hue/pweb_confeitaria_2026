<?php

namespace Database\Factories;

use App\Models\Bolo;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoloFactory extends Factory
{
    protected $model = Bolo::class;

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