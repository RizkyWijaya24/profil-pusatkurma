<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@kurma.com'],
            [
                'name'     => 'Admin Pusat Kurma',
                'email'    => 'admin@kurma.com',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            ProductSeeder::class,
            TestimonialSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
