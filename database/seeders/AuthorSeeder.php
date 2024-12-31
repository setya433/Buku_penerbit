<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'name' => 'Herlambang Setya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Putri Mawar Aulia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hilmi Nanda Reska',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
