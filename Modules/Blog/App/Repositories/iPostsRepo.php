<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\Post;

interface iPostsRepo
{

    public function all();

    public function create(array $postCredentials);

    public function update(Post $post, array $postCredentials);

    public function destroy(Post $post);

    public function postsByPublishedAt();
}
