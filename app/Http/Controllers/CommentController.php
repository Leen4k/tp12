<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use App\Models\Author;
use App\Models\Audience;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'comment' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string'
        ]);

        // Create the comment
        $comment = Comment::create([
            'name' => $request->input('comment'),
            'user_id' => $request->input('user_id'),
            'commentable_id' => $request->input('commentable_id'),
            'commentable_type' => $request->input('commentable_type')
        ]);

        // Return the created comment
        return response()->json(['comment' => $comment], 201);
    }

    public function getAllCommentsWithTopics()
    {
        $comments = Comment::with('commentable')->get();
        return response()->json($comments);
    }

}