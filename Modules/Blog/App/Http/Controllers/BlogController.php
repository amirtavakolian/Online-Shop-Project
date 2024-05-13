<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\App\Models\Post;
use Modules\Blog\App\Repositories\iCategoriesRepo;
use Modules\Blog\App\Repositories\iPostsRepo;

class BlogController extends Controller
{
    public function __construct(
        private iPostsRepo      $postsRepo,
        private iCategoriesRepo $categoriesRepo
    )
    {
    }

    public function index()
    {
        $posts = $this->postsRepo->postsByPublishedAt();
        $categoryPostsCount = $this->categoriesRepo->countCategoryPosts();
        return view('blog::blog.index', compact('posts', 'categoryPostsCount'));
    }

    public function show(Post $post)
    {
        $post = $post->load('comments');
        return view('blog::blog.show', compact('post'));
    }
}
