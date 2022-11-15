<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('devices')->insert([
            [
                'country' => 'France',
                'ip' => fake()->ipv4(),
                'name' => 'Lyon',
                'organization' => null,
                'region' => null,
                'zip' => fake()->postcode(),
                'user_id' => 1,
            ],
            [
                'country' => 'Spain',
                'ip' => fake()->ipv4(),
                'name' => 'Barcelone',
                'organization' => null,
                'region' => null,
                'zip' => fake()->postcode(),
                'user_id' => 2,
            ],
            [
                'country' => 'France',
                'ip' => fake()->ipv4(),
                'name' => 'Paris',
                'organization' => null,
                'region' => null,
                'zip' => fake()->postcode(),
                'user_id' => 3,
            ],
            [
                'country' => 'Italy',
                'ip' => fake()->ipv4(),
                'name' => 'Rome',
                'organization' => null,
                'region' => null,
                'zip' => fake()->postcode(),
                'user_id' => 4,
            ],
            [
                'country' => 'Germany',
                'ip' => fake()->ipv4(),
                'name' => 'Hamburg',
                'organization' => null,
                'region' => null,
                'zip' => fake()->postcode(),
                'user_id' => 5,
            ],
            [
                'country' => 'Italy',
                'ip' => fake()->ipv4(),
                'name' => 'Naples',
                'organization' => null,
                'region' => null,
                'zip' => fake()->postcode(),
                'user_id' => 6,
            ],
            [
                'country' => 'France',
                'ip' => fake()->ipv4(),
                'name' => 'Paris',
                'organization' => null,
                'region' => null,
                'zip' => fake()->postcode(),
                'user_id' => 7,
            ],
        ]);
    }
}
