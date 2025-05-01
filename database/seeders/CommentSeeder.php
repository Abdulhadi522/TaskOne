<?php



namespace Database\Seeders;  

use Illuminate\Database\Seeder;  
use App\Models\Comment;  

class CommentSeeder extends Seeder  
{  
    public function run()  
    {  
        // Create top-level comments  
        $topLevelComments = Comment::factory()->count(100)->create();  

        // Create nested comments for a subset of the top-level comments  
        foreach ($topLevelComments as $comment) {  
            // Random chance to create a nested comment (50% in this case)  
            if (random_int(0, 1) === 1) { // Change to $faker->boolean() for more variability  
                Comment::factory()->nested(null)->create([  
                    'parent_id' => $comment->id, // Set the parent_id to the current comment's ID  
                ]);  
            }  
        }  
    }  
}  
