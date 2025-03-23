<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
