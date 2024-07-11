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
        Schema::create('prospectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ap_paterno')->nullable();
            $table->string('ap_materno')->nullable();
            $table->string('email');
            $table->string('telefono');
            $table->boolean('activo')->default(1);
            $table->foreignId('propietario')->nullable()->constrained('users');
            $table->foreignId('asignacion')->nullable()->constrained('asignaciones');
            $table->foreignId('sede')->nullable()->constrained('sedes');
            $table->foreignId('tipo_prospecto')->nullable()->constrained('tipo_prospectos');
            $table->foreignId('status')->nullable()->constrained('status_progress');
            $table->foreignId('producto_de_interes')->nullable()->constrained('producto_de_interes');
            $table->foreignId('campana_canal')->nullable()->constrained('campana_canals');
            $table->foreignId('origen')->nullable()->constrained('origenes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospectos');
    }
};
