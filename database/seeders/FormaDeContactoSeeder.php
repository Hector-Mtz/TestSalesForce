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
            'forma' => "Llamada",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('forma_contactos')->insert([
            'forma' => "iMessage",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('forma_contactos')->insert([
            'forma' => "Email",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('forma_contactos')->insert([
            'forma' => "WhatsApp",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
