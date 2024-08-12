<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaregoriasTareasSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('caregorias_tareas')->insert([
            'nombre' => "WhatsApp",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('caregorias_tareas')->insert([
            'nombre' => "Email",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('caregorias_tareas')->insert([
            'nombre' => "Llamada",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('caregorias_tareas')->insert([
            'nombre' => "Videollamada",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 
        DB::table('caregorias_tareas')->insert([
            'nombre' => "Otro",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 
    }
}
