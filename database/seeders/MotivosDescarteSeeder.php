<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivosDescarteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('motivo_descartes')->insert([
            'nombre' => "No interesado",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('motivo_descartes')->insert([
            'nombre' => "Sin dinero",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('motivo_descartes')->insert([
            'nombre' => "Datos incorrectos",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('motivo_descartes')->insert([
            'nombre' => "Asesor inmobiliario",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('motivo_descartes')->insert([
            'nombre' => "Duplicidad",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('motivo_descartes')->insert([
            'nombre' => "Busca casa",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
