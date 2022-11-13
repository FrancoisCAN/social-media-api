<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'entitled' => 'Founder',
                'description' => 'Is given to the founder of the application and hold all rights.',
            ],
            [
                'entitled' => 'Moderator',
                'description' => 'Must ensure that the application is safe. It has many rights.',
            ],
            [
                'entitled' => 'Contributor',
                'description' => 'An upgraded version of the member with the right to contribute to the projects by submitting ideas.',
            ],
            [
                'entitled' => 'Member',
                'description' => 'Basic version of the user.',
            ]
        ]);
    }
}
