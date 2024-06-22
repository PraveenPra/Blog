<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Tag::insert([
            ['name' => 'Html'],
            ['name' => 'CSS'],
            ['name' => 'Javascript'],
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'MySQL'],
        ]);
    }
}
