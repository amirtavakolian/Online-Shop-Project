<?php

namespace Modules\Blog\App\Repositories;

use Carbon\Carbon;
use Modules\Blog\App\Models\Post;

class PostsRepo implements iPostsRepo
{
    public function all()
    {
        return Post::with('category')->with('comments')->get();
    }

    public function postsByPublishedAt()
    {
        return Post::where(function ($query) {
            $query->where('published_at', '<=', Carbon::now())
                ->orWhereNull('published_at');
        })->get();
    }

    public function create(array $postCredentials)
    {
        return Post::query()->create($postCredentials);
    }

    public function update(Post $post, array $postCredentials)
    {
        return $post->update($postCredentials);
    }

    public function destroy(Post $post)
    {
        $post->delete($post);
    }


}

