<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdiomasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('idiomas')->insert([
            'nombre' => "Inglés",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('idiomas')->insert([
            'nombre' => "Español",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
