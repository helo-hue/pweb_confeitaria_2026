<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sabor_massa',
        'recheio',
        'cobertura',
        'valor',
        'imagem'
        
    ];
}