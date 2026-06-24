<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_comment_has_fillable_attributes(): void
    {
        $comment = new Comment([
            'post_id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'content' => 'Great article!',
        ]);

        $this->assertEquals(1, $comment->post_id);
        $this->assertEquals('John Doe', $comment->name);
        $this->assertEquals('john@example.com', $comment->email);
        $this->assertEquals('Great article!', $comment->content);
    }

    public function test_comment_belongs_to_post(): void
    {
        $post = Post::factory()->create();
        
        $comment = new Comment([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'content' => 'Great article!',
        ]);
        
        $post->comments()->save($comment);

        $this->assertInstanceOf(Post::class, $comment->post);
        $this->assertEquals($post->id, $comment->post->id);
    }
}
