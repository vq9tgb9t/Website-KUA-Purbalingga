<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Services\HtmlSanitizer;
use App\Services\SlugGenerator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Berita KUA,Urab Mendoan,Artikel',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240', // Maks 10MB
        ]);

        $validated['slug'] = SlugGenerator::unique($validated['title'], new Post);
        $validated['content'] = HtmlSanitizer::clean($validated['content']);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()->route('dashboard')->with('success', 'Post berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Berita KUA,Urab Mendoan,Artikel',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240', // Maks 10MB
            'delete_image' => 'nullable|boolean',
        ]);

        $validated['slug'] = SlugGenerator::unique($validated['title'], new Post, $post->id);
        $validated['content'] = HtmlSanitizer::clean($validated['content']);

        // Jika user mencentang hapus gambar ATAU mengupload gambar baru
        if ($request->boolean('delete_image') || $request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
                $validated['image_path'] = null;
            }
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('dashboard')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post berhasil dihapus.');
    }
}
