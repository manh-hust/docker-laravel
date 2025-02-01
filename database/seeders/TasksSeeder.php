<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = DB::table('users')->pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->info('No users found. Please seed the users table first.');
            return;
        }

        DB::table('tasks')->insert([
            [
                'name' => 'Design landing page',
                'priority' => 1,
                'type' => 'INPROGRESS',
                'owner_id' => $userIds[array_rand($userIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Write blog post',
                'priority' => 2,
                'type' => 'TODO',
                'owner_id' => $userIds[array_rand($userIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fix bug #101',
                'priority' => 3,
                'type' => 'DONE',
                'owner_id' => $userIds[array_rand($userIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Client meeting',
                'priority' => 1,
                'type' => 'CANCEL',
                'owner_id' => $userIds[array_rand($userIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
