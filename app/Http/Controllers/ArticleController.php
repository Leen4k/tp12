<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'author_name' => 'required|string|max:255',
            'article_name' => 'required|string|max:255',
        ]);

        // Find the author by name
        $author = Author::where('name', $request->input('author_name'))->first();
        
        if (!$author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        // Create the article
        $article = Article::create([
            'name' => $request->input('article_name'),
            'author_id' => $author->id,
        ]);

        // Return the created article
        return response()->json($article, 201);
    }

    public function getAudiences($articleName)
    {
        $article = Article::where('name', $articleName)->first();
        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        return response()->json($article->audiences);
    }
}
