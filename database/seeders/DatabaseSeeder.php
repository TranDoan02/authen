<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@antranauthentic.vn',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        // Create Test User
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        // Seed Categories
        $this->call([
            CategorySeeder::class,
        ]);

        // Seed Products
        $this->call([
            ProductSeeder::class,
        ]);

        // Seed Post Categories
        $this->call([
            PostCategorySeeder::class,
        ]);

        // Seed Posts
        $this->call([
            PostSeeder::class,
        ]);
    }
}
