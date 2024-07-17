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
        Schema::create('ruleta_sedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('activo')->default(1);
            //$table->foreignId('sede')->nullable()->constrained('sedes');
            $table->foreignId('ruleta_general')->nullable()->constrained('ruleta_generals');
            //$table->foreignId('producto_interes')->nullable()->constrained('producto_de_interes');
            $table->foreignId('creado_por')->nullable()->constrained('users');
            $table->foreignId('tipo_asignacion')->nullable()->constrained('asignaciones');
            $table->integer('asignaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruleta_sedes');
    }
};
