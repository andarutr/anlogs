<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];
        
        for ($i = 1; $i <= 50; $i++) {
            $users[] = [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('asdf'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('users')->insert($users);
    }
}
