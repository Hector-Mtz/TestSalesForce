<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoInteresSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('producto_de_interes')->insert([
            'nombre' => "León",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('producto_de_interes')->insert([
            'nombre' => "Mérida",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('producto_de_interes')->insert([
            'nombre' => "Querétaro",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('producto_de_interes')->insert([
            'nombre' => "Cancún",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('producto_de_interes')->insert([
            'nombre' => "No estoy seguro, quiero información mas detallada",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('producto_de_interes')->insert([
            'nombre' => "Monterrey",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('producto_de_interes')->insert([
            'nombre' => "Aguascalientes",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
