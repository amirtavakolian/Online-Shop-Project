<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\App\Models\PostComment;
use Modules\Blog\App\Repositories\iCommentsRepo;

class CommentsController extends Controller
{

    public function __construct(private iCommentsRepo $commentsRepo)
    {
    }

    public function index()
    {
        $comments = $this->commentsRepo->paginate(10);
        return view('blog::blog.comments.index', compact('comments'));
    }

    public function changeCommentStatus(PostComment $comment, $status)
    {
        $this->commentsRepo->updateCommentStatus($comment, $status);
        return response()->json([
            'message' => 'ok',
            'status' => '200'
        ]);
    }
}
