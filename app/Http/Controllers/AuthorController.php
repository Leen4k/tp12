<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'author_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->input('user_name'),
        ]);

        // Create the author
        $author = Author::create([
            'name' => $request->input('author_name'),
            'user_id' => $user->id,
        ]);

        // Return the created author with user
        return response()->json(['author' => $author, 'user' => $user], 201);
    }

    public function getArticles($authorName)
    {
        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }
        return response()->json($author->articles);
    }

    public function getAudiences($authorName)
    {
        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }
        return response()->json($author->audiences);
    }
}
