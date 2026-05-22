<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
<<<<<<< HEAD
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->boolean('tem_entrega')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn('tem_entrega');
        });
    }
=======

    public function up(): void
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->boolean('tem_entrega')->default(false)->after('status');
        $table->time('hora_entrega')->nullable()->after('tem_entrega');
        $table->string('endereco_entrega')->nullable()->after('hora_entrega');
    });
}

>>>>>>> d66ebad25d997cad3da567d84d8e5f113a530a89
};