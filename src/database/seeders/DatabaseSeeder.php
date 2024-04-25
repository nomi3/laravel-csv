<?php

namespace Database\Seeders;

use App\Models\Insured;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Insured::factory()->create([
            'name' => 'Test Insured',
            'insurance_card_number' => 1234567890,
            'email' => 'test@example.com',
        ]);
    }
}
