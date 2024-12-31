<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publishers')->insert([
            [
                'name' => 'PT.Pena Kita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT.Aksara Emas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT.Mari Membaca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
