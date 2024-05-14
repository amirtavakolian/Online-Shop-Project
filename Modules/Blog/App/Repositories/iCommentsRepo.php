<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\PostComment;

interface iCommentsRepo
{
    public function paginate($count);

    public function updateCommentStatus(PostComment $comment, $status);

    public function increaseLike(PostComment $comment);

}
