<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => fake()->countryCode(),
            'ip' => fake()->ipv4(),
            'name' => fake()->city(),
            'organization' => '',
            'region' => fake()->address(),
            'zip' => fake()->postcode(),
            'user_id' => User::factory(),
        ];
    }
}
