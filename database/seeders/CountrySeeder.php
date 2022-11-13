<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            [
                'name' => 'France',
                'code' => 'FR',
            ],
            [
                'name' => 'Spain',
                'code' => 'ES',
            ],
            [
                'name' => 'Italy',
                'code' => 'IT',
            ],
            [
                'name' => 'Germany',
                'code' => 'DE',
            ],
        ]);
    }
}
