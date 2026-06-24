<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:5000',
        ]);

        $existingComment = Comment::where('email', $validated['email'])->first();

        if ($existingComment) {
            if (strtolower($existingComment->name) !== strtolower($validated['name'])) {
                return back()->withErrors([
                    'name' => 'Email ini sudah digunakan. Pastikan nama Anda sesuai dengan komentar sebelumnya, atau gunakan email lain.',
                ])->withInput();
            }

            $validated['name'] = $existingComment->name;
        }

        $post->comments()->create($validated);

        return back();
    }
}