<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Product::factory()
        //     ->count(50)
        //     ->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('admin'),
        ])
        ->detail()
        ->create([
            'avatar' => url('assets/media/avatars/avatar0.jpg'),
            'contact_number' => '09562334850',
            'address' => 'P-23'
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'role' => 'STAFF',
            'password' => Hash::make('staff'),
        ])
        ->detail()
        ->create([
            'avatar' => url('assets/media/avatars/avatar0.jpg'),
            'contact_number' => '09562334850',
            'address' => 'P-23'
        ]);
        
    }
}
