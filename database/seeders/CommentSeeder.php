<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Poadcast;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {

        $poadcasts = Poadcast::all();
        $users = User::all();
        foreach ($poadcasts as $poadcast) {
            $comments = Comment::factory(5)->create([
                'poadcast_id' => $poadcast->id,
                'user_id' => $users->random()->id,
            ]);
        foreach ($comments as $comment) {
            Comment::factory(2)->create([
                'poadcast_id' => $poadcast->id,
                'parent_id' => $comment->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
    }
}