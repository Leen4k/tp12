<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AudienceController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'audience_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'article_id' => 'required|exists:articles,id',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->input('user_name'),
        ]);

        // Create the audience
        $audience = Audience::create([
            'name' => $request->input('audience_name'),
            'user_id' => $user->id,
            'article_id' => $request->input('article_id'),
        ]);

        // Return the created audience with user
        return response()->json(['audience' => $audience, 'user' => $user], 201);
    }

    public function getComments($audienceName)
    {
        $audience = Audience::where('name', $audienceName)->first();
        if (!$audience) {
            return response()->json(['error' => 'Audience not found'], 404);
        }

        Log::info('Audience:', ['audience' => $audience]);
        Log::info('Comments:', ['comments' => $audience->comments]);

        return response()->json($audience->comments);
    }
}
