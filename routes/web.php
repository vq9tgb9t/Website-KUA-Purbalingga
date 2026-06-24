<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;

Route::get('/', function () {
    $latestPosts = Post::latest()->take(3)->get();
    return Inertia::render('Home', [
        'latestPosts' => $latestPosts
    ]);
})->name('home');

Route::get('/berita-kua', function () {
    $posts = Post::where('category', 'Berita KUA')->latest()->paginate(9);
    return Inertia::render('PostList', [
        'posts' => $posts,
        'category' => 'Berita KUA',
    ]);
})->name('posts.berita');

Route::get('/urab-mendoan', function () {
    $posts = Post::where('category', 'Urab Mendoan')->latest()->paginate(9);
    return Inertia::render('PostList', [
        'posts' => $posts,
        'category' => 'Urab Mendoan',
    ]);
})->name('posts.urab');

Route::get('/artikel', function () {
    $posts = Post::where('category', 'Artikel')->latest()->paginate(9);
    return Inertia::render('PostList', [
        'posts' => $posts,
        'category' => 'Artikel',
    ]);
})->name('posts.artikel');

Route::get('/profil', function () {
    return Inertia::render('Profil');
})->name('profil');

Route::get('/struktur-organisasi', function () {
    return Inertia::render('StrukturOrganisasi');
})->name('struktur-organisasi');

Route::get('/kabar/{post:slug}', function (Post $post) {
    $post->load('comments');
    return Inertia::render('PostDetail', [
        'post' => $post
    ]);
})->name('posts.show');

Route::post('/kabar/{post:slug}/comments', function (Request $request, Post $post) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'content' => 'required|string',
    ]);

    // Cek apakah email sudah pernah digunakan sebelumnya
    $existingComment = Comment::where('email', $validated['email'])->first();

    if ($existingComment) {
        if (strtolower($existingComment->name) !== strtolower($validated['name'])) {
            return back()->withErrors([
                'name' => 'Email ini sudah digunakan. Pastikan nama Anda sesuai dengan komentar sebelumnya, atau gunakan email lain.'
            ])->withInput();
        }
        
        // Opsional: Pastikan nama persis sama dengan yang ada di database (huruf besar/kecilnya)
        $validated['name'] = $existingComment->name;
    }

    $post->comments()->create($validated);

    return back();
})->middleware('throttle:5,1')->name('comments.store');

Route::get('/dashboard', function () {
    $posts = Post::withCount('comments')->latest()->get();
    return Inertia::render('Dashboard', [
        'posts' => $posts
    ]);
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class)->except(['show']);

    // Manajemen Komentar
    Route::get('comments', function () {
        $comments = Comment::with('post')->latest()->paginate(20);
        return Inertia::render('Admin/Comments/Index', [
            'comments' => $comments
        ]);
    })->name('comments.index');

    Route::delete('comments/{comment}', function (Comment $comment) {
        $comment->delete();
        return back();
    })->name('comments.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
