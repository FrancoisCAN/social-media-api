<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
            RightSeeder::class,
            RoleSeeder::class,
            RightRoleSeeder::class,
            UserSeeder::class,
            DeviceSeeder::class,
        ]);
    }
}
