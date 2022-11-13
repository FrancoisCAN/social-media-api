<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            [
                'name' => 'Paris',
                'country_id' => 1,
            ],
            [
                'name' => 'Marseille',
                'country_id' => 1,
            ],
            [
                'name' => 'Lyon',
                'country_id' => 1,
            ],
            [
                'name' => 'Madrid',
                'country_id' => 2,
            ],
            [
                'name' => 'Barcelone',
                'country_id' => 2,
            ],
            [
                'name' => 'Valencia',
                'country_id' => 2,
            ],
            [
                'name' => 'Rome',
                'country_id' => 3,
            ],
            [
                'name' => 'Milan',
                'country_id' => 3,
            ],
            [
                'name' => 'Naples',
                'country_id' => 3,
            ],
            [
                'name' => 'Berlin',
                'country_id' => 4,
            ],
            [
                'name' => 'Hamburg',
                'country_id' => 4,
            ],
            [
                'name' => 'Munich',
                'country_id' => 4,
            ],
        ]);
    }
}
