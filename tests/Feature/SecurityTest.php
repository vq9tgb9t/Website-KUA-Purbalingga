<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Services\HtmlSanitizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertForbidden();
    }

    public function test_non_admin_cannot_access_admin_posts(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/posts/create');

        $response->assertForbidden();
    }

    public function test_admin_can_access_dashboard(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
    }

    public function test_html_sanitizer_strips_script_tags(): void
    {
        $dirty = '<p>Hello</p><script>alert("xss")</script>';
        $clean = HtmlSanitizer::clean($dirty);

        $this->assertStringContainsString('<p>Hello</p>', $clean);
        $this->assertStringNotContainsString('<script>', $clean);
    }

    public function test_post_content_is_sanitized_on_create(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post('/admin/posts', [
            'title' => 'Security Test Post',
            'category' => 'Artikel',
            'content' => '<p>Safe</p><script>alert(1)</script>',
        ]);

        $response->assertRedirect(route('dashboard'));

        $post = Post::where('title', 'Security Test Post')->first();
        $this->assertNotNull($post);
        $this->assertStringNotContainsString('<script>', $post->content);
        $this->assertStringContainsString('<p>Safe</p>', $post->content);
    }
}