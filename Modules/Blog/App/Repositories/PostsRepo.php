<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\Post;

class PostsRepo implements iPostsRepo
{
    public function all()
    {
        return Post::with('category')->get();
    }

    public function create(array $postCredentials)
    {
        return Post::query()->create($postCredentials);
    }

    public function update(Post $post, array $postCredentials)
    {
        return $post->update($postCredentials);
    }
}
