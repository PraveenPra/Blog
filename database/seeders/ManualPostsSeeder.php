<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ManualPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $json = File::get('database/seeders/manual_posts.json');
        // $posts = json_decode($json, true);
        // Post::insert($posts);

          // Define the file path
          $filePath = 'database/seeders/manual_posts.json';

          // Check if the file exists
          if (File::exists($filePath)) {
              // Read the JSON data from the file
              $json = File::get($filePath);
  
              // Decode the JSON data into an array
              $posts = json_decode($json, true);
  
              // Iterate over each post and format the datetime fields
              foreach ($posts as &$postData) {
                // Remove the 'id' field to allow autoincrement in the database
                unset($postData['id']);

                  if (isset($postData['created_at'])) {
                      $postData['created_at'] = Carbon::parse($postData['created_at'])->format('Y-m-d H:i:s');
                  }
                  if (isset($postData['updated_at'])) {
                      $postData['updated_at'] = Carbon::parse($postData['updated_at'])->format('Y-m-d H:i:s');
                  }
              }
  
              // Insert the posts into the database
              Post::insert($posts);
          } else {
              // Inform the user that the file was not found
              $this->command->info('Manual posts JSON file not found.');
          }
      }
    
}
