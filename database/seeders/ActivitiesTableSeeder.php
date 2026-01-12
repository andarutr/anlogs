<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['login', 'visit', 'logout'];
        $pages = [
            'dashboard', 'profile', 'settings', 'home', 'about',
            'contact', 'products', 'services', 'blog', 'news',
            'admin', 'users', 'reports', 'analytics', 'api',
            'login', 'register', 'forgot-password', 'reset-password'
        ];
        
        $activities = [];
        $batchSize = 1000; 
        
        $userIds = DB::table('users')->pluck('id')->toArray();
        if (empty($userIds)) {
            Log::info('Tidak ada users ditemukan. Harap seed tabel users terlebih dahulu.');
            throw new \Exception('Tidak ada users ditemukan. Harap seed tabel users terlebih dahulu.');
        }
        
        for ($i = 1; $i <= 10500; $i++) {
            $activities[] = [
                'user_id' => $userIds[array_rand($userIds)],
                'action' => $actions[array_rand($actions)],
                'page' => $pages[array_rand($pages)],
                'ip_address' => fake()->ipv4(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Batching per 1000 data agar optimize
            if ($i % $batchSize === 0 || $i === 10500) {
                DB::table('activities')->insert($activities);
                $activities = []; // Reset array
            }
        }
    }
}
