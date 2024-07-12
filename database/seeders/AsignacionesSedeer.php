<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsignacionesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('asignaciones')->insert([
            'nombre' => "Sede",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('asignaciones')->insert([
            'nombre' => "Producto",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('asignaciones')->insert([
            'nombre' => "Nacional",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('asignaciones')->insert([
            'nombre' => "Zona / Grupo de sede",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
