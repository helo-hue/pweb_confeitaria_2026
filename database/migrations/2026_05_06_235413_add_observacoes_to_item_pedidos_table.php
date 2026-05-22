<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('item_pedidos', function (Blueprint $table) {
        $table->string('observacoes')->nullable()->after('valor_unitario');
    });
}

public function down(): void
{
    Schema::table('item_pedidos', function (Blueprint $table) {
        $table->dropColumn('observacoes');
    });
}
};
