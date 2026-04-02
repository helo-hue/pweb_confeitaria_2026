<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receita;

class ReceitaSeeder extends Seeder
{
    public function run()
    {
        Receita::factory(10)->create();
    }
}