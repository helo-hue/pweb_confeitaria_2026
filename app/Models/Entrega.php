<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $fillable = [
        'pedido_id',
        'nome_retirador',
        'endereco',
        'hora_entrega',
        'status',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}