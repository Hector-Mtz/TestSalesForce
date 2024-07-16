<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusquedaTerrenoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('busqueda_terrenos')->insert([
            'nombre' => "Patrimonio",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('busqueda_terrenos')->insert([
            'nombre' => "Inversión",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
