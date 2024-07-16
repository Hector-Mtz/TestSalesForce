<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MontoEngancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('monto_enganches')->insert([
            'cantidad' => "$ 50,001 o más",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        DB::table('monto_enganches')->insert([
            'cantidad' => "$ 5,000 - $ 15,000",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        
        DB::table('monto_enganches')->insert([
            'cantidad' => "$ 15,001 - $ 30,000",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        DB::table('monto_enganches')->insert([
            'cantidad' => "$ 30,000 - $ 50,000",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        DB::table('monto_enganches')->insert([
            'cantidad' => "300 USD - 900 USD",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        DB::table('monto_enganches')->insert([
            'cantidad' => "900 USD - 1,700 USD",
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        DB::table('monto_enganches')->insert([
            'cantidad' => "1,700 USD - 3,000 USD",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('monto_enganches')->insert([
            'cantidad' => "3,000 USD o más",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
