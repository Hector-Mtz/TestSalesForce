<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InversionAlMesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('inversion_al_mes')->insert([
            'nombre' => "$1,500 - $3,000 MXN",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('inversion_al_mes')->insert([
            'nombre' => "$$3,001- $5,000 MXN",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('inversion_al_mes')->insert([
            'nombre' => "+ $5,000 MXN",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('inversion_al_mes')->insert([
            'nombre' => "Quiero conocer los planes de pago",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('inversion_al_mes')->insert([
            'nombre' => "$80 - $150 USD",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('inversion_al_mes')->insert([
            'nombre' => "$151 - $250 USD",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('inversion_al_mes')->insert([
            'nombre' => "+ $250 USD",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
