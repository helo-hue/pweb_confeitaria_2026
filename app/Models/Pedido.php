<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'bolo_id',
        'quantidade',
        'valor_total',
        'data_pedido',
        'data_entrega',
        'forma_pagamento',
        'status',
    ];

    // Relacionamentos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function bolo()
    {
        return $this->belongsTo(Bolo::class);
    }
}