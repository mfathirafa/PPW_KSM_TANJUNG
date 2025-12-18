<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['phone' => '08156640837'],
            [
                'name' => 'Admin KSM',
                'role' => 'admin',
            ]
        );
    }
}
