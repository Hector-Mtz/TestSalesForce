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
            $table->string('apellidos')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('activo')->default(1);
            $table->string('mensaje')->nullable();
            $table->foreignId('propietario')->nullable()->constrained('users');
            $table->foreignId('vendedor anterior')->nullable()->constrained('users');
            $table->foreignId('asignacion')->nullable()->constrained('asignaciones');
            $table->foreignId('sede')->nullable()->constrained('sedes');
            $table->foreignId('tipo_prospecto')->nullable()->constrained('tipo_prospectos');
            $table->foreignId('status')->nullable()->constrained('status_progress');
            $table->foreignId('producto_de_interes')->nullable()->constrained('producto_de_interes');
            $table->foreignId('campana_canal')->nullable()->constrained('campana_canals');
            $table->foreignId('origen')->nullable()->constrained('origenes');
            $table->foreignId('monto_enganche')->nullable()->constrained('monto_enganches');
            $table->foreignId('forma_contacto')->nullable()->constrained('forma_contactos');
            $table->foreignId('horario_contacto')->nullable()->constrained('horario_contactos');
            $table->foreignId('busqueda_terreno')->nullable()->constrained('busqueda_terrenos');
            $table->foreignId('inversion_al_mes')->nullable()->constrained('inversion_al_mes');
            $table->string('tiempo_inversion')->nullable();
            $table->foreignId('idioma')->nullable()->constrained('idiomas');
            $table->boolean('Estado de integración')->default(0);
            $table->string('Id Dragón')->nullable();
            $table->string('Id Analista')->nullable();
            $table->string('UTM Source')->nullable();
            $table->string('UTM Content')->nullable();
            $table->string('UTM Medium')->nullable();
            $table->string('UTM Campaign')->nullable();
            $table->string('UTM Term')->nullable();
            $table->string('First Click')->nullable();
            $table->string('First Click Campaign')->nullable();
            $table->string('GCLID')->nullable();
            $table->string('IP Adress')->nullable();
            $table->string('Device')->nullable();
            $table->string('Operating System')->nullable();
            $table->string('Browser')->nullable();
            $table->string('First Click Content')->nullable();
            $table->string('First Click Landing Page')->nullable();
            $table->string('Time Zone')->nullable();
            $table->string('City')->nullable();
            $table->string('Country')->nullable();
            $table->string('State')->nullable();
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
