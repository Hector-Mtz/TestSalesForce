<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProspectosSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_prospectos')->insert([
            'nombre' => "Prospecto",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('tipo_prospectos')->insert([
            'nombre' => "Oportunidad",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('tipo_prospectos')->insert([
            'nombre' => "Venta",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
