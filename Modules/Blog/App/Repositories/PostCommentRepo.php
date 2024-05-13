<?php

namespace Modules\Blog\App\Repositories;

use Modules\Auth\App\Models\User;

class PostCommentRepo implements iPostCommentRepo
{

    public function store(User $user, array $postCommentData)
    {
        return $user->postComment()->create($postCommentData);
    }
}
