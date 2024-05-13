<?php

namespace Modules\Blog\App\Repositories;

use Modules\Auth\App\Models\User;
use Modules\Blog\App\Models\Post;

interface iPostCommentRepo
{
    public function store(User $user, array $postCommentData);
}
