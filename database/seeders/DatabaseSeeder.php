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
        User::create([
            'name'     => 'Admin',
            'email'    => 'silannaybekk@gmail.com',
            'password' => bcrypt('silan1234'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Test Kullanıcı',
            'email'    => 'user@shopzone.com',
            'password' => bcrypt('user123'),
            'role'     => 'user',
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
