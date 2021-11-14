<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Product;
use App\Models\Reminder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(50)
            ->create();

        // Appointment::factory()
        //     ->count(50)
        //     ->create();

        // Reminder::factory()
        //     ->count(50)
        //     ->create();
    }
}
