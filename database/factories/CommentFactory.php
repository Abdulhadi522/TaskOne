<?php

// database/factories/CommentFactory.php  
namespace Database\Factories;

use App\Models\Comment;
use App\Models\Poadcast;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;

    public function definition()
    {
        return [
            'poadcast_id' => Poadcast::factory(),
            'user_id' => User::factory(),
            'text' => $this->faker->sentence,
            'parent_id' => null  
        ];
    }

    public function nested($parentId)
    {
        return $this->state([
            'parent_id' => $parentId,
        ]);
    }
}
