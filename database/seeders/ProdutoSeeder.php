<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class produtoseeder extends Seeder
{
    public function run()
    {
        Produto::factory()->count(10)->create(); 
    }
}