<?php

namespace Database\Seeders;

use App\Enums\City;
use App\Enums\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'avatar' => '/users/1/avatar/'.Str::random(10).'.png',
                'bio' => 'Welcome to my app.',
                'email' => 'francoiscan@gmail.com',
                'email_verified_at' => now(),
                'firstname' => 'Francois',
                'is_online' => true,
                'lastname' => 'Cancalon',
                'password' => Hash::make('password'),
                'phone' => '0601020304',
                'remember_token' => Str::random(40),
                'city_id' => City::LYON,
                'role_id' => Role::FOUNDER,
            ],
            [
                'avatar' => '/users/2/avatar/'.Str::random(10).'.png',
                'bio' => 'My new bio !',
                'email' => fake()->safeEmail(),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'is_online' => fake()->boolean(),
                'lastname' => fake()->lastName(),
                'password' => Hash::make('password'),
                'phone' => fake()->phoneNumber(),
                'remember_token' => Str::random(40),
                'city_id' => City::BARCELONE,
                'role_id' => Role::MODERATOR,
            ],
            [
                'avatar' => '/users/3/avatar/'.Str::random(10).'.png',
                'bio' => 'Hello !',
                'email' => fake()->safeEmail(),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'is_online' => fake()->boolean(),
                'lastname' => fake()->lastName(),
                'password' => Hash::make('password'),
                'phone' => fake()->phoneNumber(),
                'remember_token' => Str::random(40),
                'city_id' => City::PARIS,
                'role_id' => Role::CONTRIBUTOR,
            ],
            [
                'avatar' => '/users/4/avatar/'.Str::random(10).'.png',
                'bio' => 'I just discover this new application.',
                'email' => fake()->safeEmail(),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'is_online' => fake()->boolean(),
                'lastname' => fake()->lastName(),
                'password' => Hash::make('password'),
                'phone' => fake()->phoneNumber(),
                'remember_token' => Str::random(40),
                'city_id' => City::ROME,
                'role_id' => Role::MEMBER,
            ],
            [
                'avatar' => '/users/5/avatar/'.Str::random(10).'.png',
                'bio' => null,
                'email' => fake()->safeEmail(),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'is_online' => fake()->boolean(),
                'lastname' => fake()->lastName(),
                'password' => Hash::make('password'),
                'phone' => fake()->phoneNumber(),
                'remember_token' => Str::random(40),
                'city_id' => City::HAMBURG,
                'role_id' => Role::MEMBER,
            ],
            [
                'avatar' => '/users/6/avatar/'.Str::random(10).'.png',
                'bio' => 'This is my new bio. Please like my posts.',
                'email' => fake()->safeEmail(),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'is_online' => fake()->boolean(),
                'lastname' => fake()->lastName(),
                'password' => Hash::make('password'),
                'phone' => fake()->phoneNumber(),
                'remember_token' => Str::random(40),
                'city_id' => City::NAPLES,
                'role_id' => Role::MEMBER,
            ],
            [
                'avatar' => '/users/7/avatar/'.Str::random(10).'.png',
                'bio' => 'Hi, welcome to my profil.',
                'email' => fake()->safeEmail(),
                'email_verified_at' => now(),
                'firstname' => fake()->firstName(),
                'is_online' => fake()->boolean(),
                'lastname' => fake()->lastName(),
                'password' => Hash::make('password'),
                'phone' => fake()->phoneNumber(),
                'remember_token' => Str::random(40),
                'city_id' => City::PARIS,
                'role_id' => Role::MEMBER,
            ],
        ]);
    }
}
