<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Herlambang Setya',
            'username' => 'herlambang',
            'author_id' => 1,
            'role'=>'author',
            'email' => 'herlambang@example.com',
            'password' => Hash::make('password123'), // Password hashed
        ]);

        User::create([
            'name' => 'Putri Mawar Aulia',
            'username' => 'putri',
            'author_id' => 2,
            'role' => 'author',
            'email' => 'putri@example.com',
            'password' => Hash::make('password123'), // Password hashed
        ]);

        User::create([
            'name' => 'Hilmi Nanda Reska',
            'username' => 'hilmi',
            'role' => 'author',
            'author_id' => 3,
            'email' => 'hilmi@example.com',
            'password' => Hash::make('password123'), // Password hashed
        ]);

        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'role' => 'admin',
            'author_id' => 2,
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Password hashed
        ]);
    }
}
