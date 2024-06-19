<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@a.com')->first();
        $category = Category::first();

        // Create a post
        DB::transaction(function () use ($user, $category) {
        $post = Post::create([
            'user_id' => $user->id,
            'title' => 'First Post',
            'body' => 'This is the body of the first post.',
            'category_id' => $category->id
        ]);

        // Assign tags to the post
        $post->tags()->attach(Tag::all());
        //  $post->tags()->attach($tags->pluck('id'));
        });

        $this->command->info('Post seeded successfully with tags.');
    
    }
}
