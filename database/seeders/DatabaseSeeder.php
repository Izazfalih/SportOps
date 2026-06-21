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
        // Venue
        $venue = \App\Models\Venue::updateOrCreate(
            ['nama_venue' => 'SportOps Arena'],
            [
                'alamat' => 'Jl. Olahraga No. 1, Jakarta',
                'kontak' => '081200001111',
                'open_time' => '08:00',
                'close_time' => '23:00'
            ]
        );

        // Fields
        \App\Models\Field::updateOrCreate(
            ['nama_lapangan' => 'Futsal — Synthetic Grass'],
            ['venue_id' => $venue->id, 'jenis_olahraga' => 'Futsal', 'status' => 'aktif']
        );
        \App\Models\Field::updateOrCreate(
            ['nama_lapangan' => 'Premium Futsal — Vinyl'],
            ['venue_id' => $venue->id, 'jenis_olahraga' => 'Premium Futsal', 'status' => 'aktif']
        );
        \App\Models\Field::updateOrCreate(
            ['nama_lapangan' => 'Badminton'],
            ['venue_id' => $venue->id, 'jenis_olahraga' => 'Badminton', 'status' => 'aktif']
        );
        \App\Models\Field::updateOrCreate(
            ['nama_lapangan' => 'Basketball'],
            ['venue_id' => $venue->id, 'jenis_olahraga' => 'Basketball', 'status' => 'aktif']
        );
    }
}
