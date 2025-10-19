<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder untuk tabel users (manual)
        DB::table('users')->insert([
            'Nama' => 'Test User',
            'Email' => 'test@example.com',
            'Password' => Hash::make('123456'),
            'Role' => 'pelanggan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Jalankan AdminSeeder
        $this->call(AdminSeeder::class);
    }
}
