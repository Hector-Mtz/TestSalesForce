<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaDeContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('forma_contactos')->insert([
            'nombre' => "Llamada",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('forma_contactos')->insert([
            'nombre' => "iMessage",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('forma_contactos')->insert([
            'nombre' => "Email",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('forma_contactos')->insert([
            'nombre' => "WhatsApp",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
