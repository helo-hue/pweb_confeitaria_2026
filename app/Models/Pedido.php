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
<<<<<<< HEAD
=======
    'hora_entrega',
    'endereco_entrega',
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
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
<<<<<<< HEAD
    }

    public function entrega()
    {
        return $this->hasOne(Entrega::class);
=======
>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
    }

    public function entrega()
    {
        return $this->hasOne(Entrega::class);
    }
    
}