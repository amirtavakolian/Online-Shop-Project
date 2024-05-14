<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\PostComment;

class CommentsRepo implements iCommentsRepo
{

    public function paginate($count)
    {
        return PostComment::paginate($count);
    }

    public function updateCommentStatus(PostComment $comment, $status)
    {
        $comment->update([
            'status' => $status
        ]);
    }

    public function increaseLike(PostComment $comment)
    {
        $comment->update([
            'like' => $comment->like + 1
        ]);
    }

    public function increaseDisslike(PostComment $comment)
    {
        $comment->update([
            'dislike' => $comment->dislike + 1
        ]);
    }
}

