<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrigenesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('origenes')->insert([
            'nombre' => "blog",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "Calendly",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "Cintillo Web",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "facebook",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "facebook_ads",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "flyers",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "google",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "google_ads",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "Instagram",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "Instagram_ads",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "Landing",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "Website",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "Twitter",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "TikTok",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('origenes')->insert([
            'nombre' => "WhatsApp",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
