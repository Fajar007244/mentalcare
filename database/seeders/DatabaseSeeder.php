<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            QuizSeeder::class,
        ]);

        try {
            DB::table('users')->insert([
                'name' => 'Test User',
                'email' => 'test@mentalcare.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error seeding user: ' . $e->getMessage());
            // Optionally re-throw if you want the seeder to fail
            // throw $e;
        }
    }
}
