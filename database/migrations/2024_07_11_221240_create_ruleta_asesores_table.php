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
        Schema::create('ruleta_asesores', function (Blueprint $table) {
            $table->id();
            $table->boolean('activo')->default(1);
            $table->foreignId('ruleta_sede')->nullable()->constrained('ruleta_sedes');
            $table->integer('asignaciones');
            $table->foreignId('creado_por')->nullable()->constrained('users');
            $table->foreignId('asesor')->nullable()->constrained('asesores');
            $table->dateTime('ultima_asignacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruleta_asesores');
    }
};
