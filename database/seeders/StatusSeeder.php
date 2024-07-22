<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('status_progress')->insert([
            'nombre' => "Nuevo",
            'tipo_prospecto_status' => 1, //Prospecto
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('status_progress')->insert([
            'nombre' => "Junk",
            'tipo_prospecto_status' => 1, //Prospecto
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('status_progress')->insert([
            'nombre' => "Contactado",
            'tipo_prospecto_status' => 1, //Prospecto
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('status_progress')->insert([
            'nombre' => "Interesado",
            'tipo_prospecto_status' => 1, //Prospecto
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
