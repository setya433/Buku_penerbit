<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        \App\Models\Book::factory(15)->create();
    }
}
