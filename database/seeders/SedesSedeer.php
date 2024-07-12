<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('sedes')->insert([
            'nombre' => "CDMX",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "EDOMEX",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Monterrey",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Tijuana",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Guadalajara",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Puebla",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Cancún",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "León",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Mérida",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "San Luis Potosí",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Querétaro",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Texas",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Aguascalientes",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Estados Unidos",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Península",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Monterrey A",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Monterrey B",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Morelia",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Florida",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sedes')->insert([
            'nombre' => "Houston_TX",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
