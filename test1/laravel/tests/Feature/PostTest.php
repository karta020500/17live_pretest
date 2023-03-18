<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_post()
    {
      // Arrange
        $data = [
          'title' => 'Test Post',
          'content' => 'This is a test post.'
      ];

      // Act
      $response = $this->post('/api/posts', $data);

      // Assert
      $response->assertStatus(201);
      $this->assertDatabaseHas('posts', $data);
    }

    public function test_create_comment_for_post()
    {
        // Arrange
        $post = Post::factory()->create();
        $data = [
            'message' => 'Test Comment',
        ];

        // Act
        $response = $this->post(route('comments.store', ['post_id' => $post->id]), $data);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', $data);
    }
}
