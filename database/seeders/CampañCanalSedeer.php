<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampañCanalSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('campana_canals')->insert([
            'nombre' => "blog",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "Calendly",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "Cintillo Web",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "facebook",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "facebook_ads",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "flyers",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "google",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "google_ads",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "Instagram",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "Instagram_ads",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "Landing",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "Website",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "Twitter",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "TikTok",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('campana_canals')->insert([
            'nombre' => "WhatsApp",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
