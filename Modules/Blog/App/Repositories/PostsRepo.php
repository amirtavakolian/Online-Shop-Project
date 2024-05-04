<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\Post;

class PostsRepo implements iPostsRepo
{
    public function all()
    {
        return Post::all();
    }

    public function create(array $postCredentials)
    {
        return Post::query()->create($postCredentials);
    }
}
