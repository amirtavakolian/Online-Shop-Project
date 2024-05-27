<?php

namespace Modules\Blog\App\Policies;

use Modules\Auth\App\Models\User;
use Modules\Blog\App\Models\Post;

class PostPolicy
{

    public function edit(User $user, Post $post): bool
    {
        return $user->isWriter() && $user->id == $post->user->id ? true : false;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->isWriter() && $user->id == $post->user->id ? true : false;
    }

    public function destroy(User $user, Post $post): bool
    {
        return $user->isWriter() && $user->id == $post->user->id ? true : false;
    }

    public function create(User $user)
    {
        return $user->isWriter();
    }
}
