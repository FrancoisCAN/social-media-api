<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('rights')->insert([
            [
                'entitled' => 'canCreateConversation',
            ],
            [
                'entitled' => 'canCreatePost',
            ],
            [
                'entitled' => 'canModifyRole',
            ],
            [
                'entitled' => 'canDeleteUser',
            ],
        ]);
    }
}
