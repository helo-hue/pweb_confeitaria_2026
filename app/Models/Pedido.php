<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'valor_total',
        'data_pedido',
        'data_entrega',
        'forma_pagamento',
        'status',
        'tem_entrega',
    'hora_entrega',
    'endereco_entrega',
    ];

    protected $casts = [
        'tem_entrega' => 'boolean',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function entrega()
    {
        return $this->hasOne(Entrega::class);
    }
    
}