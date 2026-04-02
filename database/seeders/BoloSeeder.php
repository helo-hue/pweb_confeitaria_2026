<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bolo;

class BoloSeeder extends Seeder
{
    public function run()
    {
        Bolo::factory()->count(10)->create(); 
    }
}