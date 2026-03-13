<?php

namespace Database\Seeders;

use App\Models\FoodShare;
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
        User::query()->create([
            'name' => 'Admin ShareMeal',
            'email' => 'admin@sharemeal.test',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        $donator = User::query()->create([
            'name' => 'Donator ShareMeal',
            'email' => 'donator@sharemeal.test',
            'role' => 'donator',
            'password' => Hash::make('password123'),
        ]);

        User::factory()->count(3)->create([
            'role' => 'donator',
        ]);

        FoodShare::factory()->count(10)->for($donator)->create();
    }
}
