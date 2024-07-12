<?php

namespace Database\Seeders;

use App\Models\CaregoriasTarea;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolesSeeder::class,
            SedesSedeer::class,
            UserSeeder::class,
            ProductoInteresSedeer::class,
            CampañCanalSedeer::class,
            AsignacionesSedeer::class,
            OrigenesSedeer::class,
            CaregoriasTareasSedeer::class,
            TipoProspectosSedeer::class
        ]);
    }
}
