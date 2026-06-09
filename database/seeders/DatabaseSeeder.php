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
            'email'    => env('ADMIN_EMAIL', 'admin@pikselpazar.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Test Kullanıcı',
            'email'    => env('USER_EMAIL', 'user@pikselpazar.com'),
            'password' => bcrypt(env('USER_PASSWORD', 'password')),
            'role'     => 'user',
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
