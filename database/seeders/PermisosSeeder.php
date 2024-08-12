<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('permisos')->insert([
            'nombre' => "watch-reportes",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permisos')->insert([
            'nombre' => "admin",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permisos')->insert([
            'nombre' => "watch-ruletas",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permisos')->insert([
            'nombre' => "watch-catalogos",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
