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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('comentarios')->nullable();
            $table->string('mensaje_whats')->nullable();
            $table->string('from_email')->nullable();
            $table->string('to_email')->nullable();
            $table->string('asunto_mail')->nullable();
            $table->string('cuerpo_mail')->nullable();
            $table->foreignId('cat_tareas')->nullable()->constrained('caregorias_tareas');
            $table->foreignId('prospecto_id')->nullable()->constrained('prospectos');
            $table->foreignId('asesor')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
