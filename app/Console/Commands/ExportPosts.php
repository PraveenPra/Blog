<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class ExportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =  'export:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export posts to a JSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::all();
        // File::put('database/seeders/manual_posts.json', $posts->toJson());

        //absolute path so that it works on from any location
        $filePath = base_path('database/seeders/manual_posts.json');
        File::put($filePath, $posts->toJson());
        
        $this->info('Posts have been exported to database/seeders/manual_posts.json');
        return 0;
    }
}
