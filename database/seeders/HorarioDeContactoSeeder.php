<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioDeContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('horario_contactos')->insert([
            'nombre' => "Mañana",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('horario_contactos')->insert([
            'nombre' => "Tarde",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('horario_contactos')->insert([
            'nombre' => "Noche",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
