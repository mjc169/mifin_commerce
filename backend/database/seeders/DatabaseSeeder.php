<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mifin User',
            'email' => 'mifin@example.com',
            'balance' => 1000.00
        ]);

        User::factory(9)->create();
    }
}
