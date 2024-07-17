<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ruleta_sede_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruleta_sede_id')->constrained('ruleta_sedes'); 
            $table->foreignId('producto_id')->constrained('productos_de_interes'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruleta_sede_productos');
    }
};
