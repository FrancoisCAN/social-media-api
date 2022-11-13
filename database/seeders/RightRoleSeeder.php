<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RightRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('rights_roles')->insert([
            [
                'right_id' => 1,
                'role_id' => 1,
                'is_allowed' => true,
            ],
            [
                'right_id' => 2,
                'role_id' => 1,
                'is_allowed' => true,
            ],
            [
                'right_id' => 3,
                'role_id' => 1,
                'is_allowed' => true,
            ],
            [
                'right_id' => 4,
                'role_id' => 1,
                'is_allowed' => true,
            ],
            [
                'right_id' => 1,
                'role_id' => 2,
                'is_allowed' => true,
            ],
            [
                'right_id' => 2,
                'role_id' => 2,
                'is_allowed' => true,
            ],
            [
                'right_id' => 3,
                'role_id' => 2,
                'is_allowed' => true,
            ],
            [
                'right_id' => 4,
                'role_id' => 2,
                'is_allowed' => true,
            ],
            [
                'right_id' => 1,
                'role_id' => 3,
                'is_allowed' => true,
            ],
            [
                'right_id' => 2,
                'role_id' => 3,
                'is_allowed' => true,
            ],
            [
                'right_id' => 3,
                'role_id' => 3,
                'is_allowed' => false,
            ],
            [
                'right_id' => 4,
                'role_id' => 3,
                'is_allowed' => false,
            ],
            [
                'right_id' => 1,
                'role_id' => 4,
                'is_allowed' => true,
            ],
            [
                'right_id' => 2,
                'role_id' => 4,
                'is_allowed' => true,
            ],
            [
                'right_id' => 3,
                'role_id' => 4,
                'is_allowed' => false,
            ],
            [
                'right_id' => 4,
                'role_id' => 4,
                'is_allowed' => false,
            ],
        ]);
    }
}
