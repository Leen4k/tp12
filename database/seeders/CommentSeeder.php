<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Audience;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $audience = Audience::where('name', 'Veasna')->first();
        $user = User::find(1); // Assuming User ID 1 exists

        Comment::create([
            'name' => 'This is a test comment',
            'user_id' => $user->id,
            'commentable_id' => $audience->id,
            'commentable_type' => Audience::class,
        ]);
    }
}
