<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'content' => 'Komentar yang valid dan informatif.',
        ], $overrides);
    }

    public function test_guest_can_submit_comment_on_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->post(route('comments.store', $post), $this->validPayload());

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'content' => 'Komentar yang valid dan informatif.',
        ]);
    }

    public function test_comment_requires_name_email_and_content(): void
    {
        $post = Post::factory()->create();

        $response = $this->post(route('comments.store', $post), []);

        $response->assertSessionHasErrors(['name', 'email', 'content']);
        $this->assertDatabaseCount('comments', 0);
    }

    public function test_comment_content_cannot_exceed_5000_characters(): void
    {
        $post = Post::factory()->create();

        $response = $this->post(route('comments.store', $post), $this->validPayload([
            'content' => str_repeat('a', 5001),
        ]));

        $response->assertSessionHasErrors(['content']);
        $this->assertDatabaseCount('comments', 0);
    }

    public function test_comment_accepts_content_up_to_5000_characters(): void
    {
        $post = Post::factory()->create();
        $content = str_repeat('a', 5000);

        $response = $this->post(route('comments.store', $post), $this->validPayload([
            'content' => $content,
        ]));

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'content' => $content,
        ]);
    }

    public function test_comment_rejects_mismatched_name_for_existing_email(): void
    {
        $postA = Post::factory()->create();
        $postB = Post::factory()->create();

        Comment::create([
            'post_id' => $postA->id,
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'content' => 'Komentar pertama',
        ]);

        $response = $this->post(route('comments.store', $postB), $this->validPayload([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'content' => 'Komentar kedua',
        ]));

        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseCount('comments', 1);
    }

    public function test_comment_accepts_matching_name_for_existing_email_case_insensitive(): void
    {
        $postA = Post::factory()->create();
        $postB = Post::factory()->create();

        Comment::create([
            'post_id' => $postA->id,
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'content' => 'Komentar pertama',
        ]);

        $response = $this->post(route('comments.store', $postB), $this->validPayload([
            'name' => 'budi',
            'email' => 'budi@example.com',
            'content' => 'Komentar kedua',
        ]));

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('comments', [
            'post_id' => $postB->id,
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'content' => 'Komentar kedua',
        ]);
    }

    public function test_comment_stores_plain_text_without_html_execution(): void
    {
        $post = Post::factory()->create();

        $this->post(route('comments.store', $post), $this->validPayload([
            'content' => '<script>alert("xss")</script> Halo',
        ]));

        $comment = Comment::first();
        $this->assertNotNull($comment);
        $this->assertSame('<script>alert("xss")</script> Halo', $comment->content);
    }
}