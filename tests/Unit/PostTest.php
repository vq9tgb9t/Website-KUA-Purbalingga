<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_has_fillable_attributes(): void
    {
        $post = new Post([
            'title' => 'Test Title',
            'slug' => 'test-title',
            'content' => 'Test Content',
            'image_path' => 'path/to/image.jpg',
            'category' => 'Technology',
        ]);

        $this->assertEquals('Test Title', $post->title);
        $this->assertEquals('test-title', $post->slug);
        $this->assertEquals('Test Content', $post->content);
        $this->assertEquals('path/to/image.jpg', $post->image_path);
        $this->assertEquals('Technology', $post->category);
    }

    public function test_post_has_many_comments(): void
    {
        $post = Post::factory()->create();
        
        // This assumes CommentFactory exists, if not we can manually create
        $comment = new Comment([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'content' => 'Nice post!',
        ]);
        
        $post->comments()->save($comment);

        $this->assertTrue($post->comments->contains($comment));
        $this->assertEquals(1, $post->comments->count());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $post->comments);
    }
}
