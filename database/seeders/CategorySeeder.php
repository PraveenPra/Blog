<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Tech'],
            ['name' => 'How To Do'],
            ['name' => 'How To Fix'],
            ['name' => 'Science'],
            ['name' => 'Health'],
            ['name' => 'Food'],
            ['name' => 'Travel'],
            ['name' => 'Fashion'],
            ['name' => 'Entertainment'],
            ['name' => 'Sports'],
            ['name' => 'Business'],
            ['name' => 'Music'],
            ['name' => 'Gaming'],

        ]);
    }
}
