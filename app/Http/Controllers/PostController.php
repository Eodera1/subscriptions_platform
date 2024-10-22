<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Website;

class PostController extends Controller
{
    // Store a method to create a post for a website
    public function store(Request $request, Website $website)
    {
        // Validate the rquest data
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        // Create a new post for the given website
        $post = $website->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Return the created post with a 201 status code
        return response()->json($post, 201);
    }
}