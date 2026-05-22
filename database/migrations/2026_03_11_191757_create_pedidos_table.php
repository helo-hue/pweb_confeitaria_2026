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

            // Dados do pedido
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->date('data_pedido');
            $table->date('data_entrega')->nullable();
            $table->string('forma_pagamento', 50)->default('não definido');
            $table->string('status', 20)->default('pendente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};