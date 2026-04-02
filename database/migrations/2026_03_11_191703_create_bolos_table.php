<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
public function up()
{
    Schema::create('bolos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('sabor_massa');
        $table->string('recheio');
        $table->string('cobertura');
        $table->decimal('valor', 8, 2);
        $table->string('imagem')->nullable(); 
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('bolos');
}
};
