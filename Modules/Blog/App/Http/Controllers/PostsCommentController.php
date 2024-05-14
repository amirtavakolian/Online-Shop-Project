<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\App\Http\Requests\StorePostsComentRequest;
use Modules\Blog\App\Models\Post;
use Modules\Blog\App\Models\PostComment;
use Modules\Blog\App\Repositories\iPostCommentRepo;

class PostsCommentController extends Controller
{

    public function __construct(private iPostCommentRepo $postCommentRepo)
    {
    }

    public function store(Post $post, StorePostsComentRequest $request)
    {
        $postCommentCredential = ['content' => $request->input('content'), 'post_id' => $post->id];
        $this->postCommentRepo->store(auth()->user(), $postCommentCredential);
        return redirect()->back()->with('success', 'کامنت شما پس از تایید ادمین؛ نمایش داده خواهد شد');
    }

    public function storeCommentReply(Post $post, PostComment $postComment, Request $request)
    {
        $post->comments()->create([
            "user_id" => auth()->user()->id,
            "content" => $request->input('content'),
            "parent_id" => $postComment->id
        ]);
        return response()->json([
            'message' => 'ok',
            'status' => 200
        ]);
    }


}
