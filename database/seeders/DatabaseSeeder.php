<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'aaa@example.com'],
            [
                'name' => 'Salem Amad',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ]
            
            // ['email' => 'ziad@example.com'],
            // [
            //     'name' => 'Ziyad Riyad',
            //     'password' => Hash::make('123456789'),
            //     'role' => 'admin',
            // ]
    );
}
}
