<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            
            // Relacionamentos
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('bolo_id')->constrained('bolos')->onDelete('cascade');

            // Dados do pedido
            $table->decimal('quantidade', 8, 2);
            $table->decimal('valor_total', 10, 2);
            $table->date('data_pedido');
            $table->date('data_entrega')->nullable();
            $table->string('forma_pagamento', 50)->default('não definido');
            $table->string('status', 20)->default('pendente'); // ex: pendente, pago, entregue

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};