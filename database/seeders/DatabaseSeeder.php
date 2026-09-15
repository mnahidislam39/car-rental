<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Customer User
        User::create([
            'name' => 'John Doe',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Dummy Cars
        Car::create([
            'name' => 'Toyota Camry',
            'brand' => 'Toyota',
            'model' => 'Camry 2023',
            'year' => 2023,
            'car_type' => 'Sedan',
            'daily_rent_price' => 50.00,
            'availability' => true,
        ]);

        Car::create([
            'name' => 'BMW X5',
            'brand' => 'BMW',
            'model' => 'X5 xDrive',
            'year' => 2024,
            'car_type' => 'SUV',
            'daily_rent_price' => 120.00,
            'availability' => true,
        ]);
    }
}
