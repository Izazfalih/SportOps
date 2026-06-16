<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sportops.id'],
            [
                'name' => 'Admin SportOps',
                'phone' => '081234567890',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@sportops.id'],
            [
                'name' => 'Pak Joko',
                'phone' => '081298765432',
                'role' => 'penjaga',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@sportops.id'],
            [
                'name' => 'Rizky Maulana',
                'phone' => '081211112222',
                'role' => 'user',
                'password' => Hash::make('password'),
            ]
        );
    }
}
