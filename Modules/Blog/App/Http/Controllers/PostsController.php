<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\App\Http\Requests\StorePostRequest;
use Modules\Blog\App\Repositories\iCategoriesRepo;
use Modules\Blog\App\Repositories\iPostsRepo;
use Modules\Blog\App\Services\FileUploader\FileUploaderBuilder;
use Modules\Blog\App\Services\TimestampConverter\TimestampConverterService;

class PostsController extends Controller
{
    public function __construct(
        private iPostsRepo          $postsRepo,
        private iCategoriesRepo     $categoriesRepo,
        private FileUploaderBuilder $fileUploaderBuilder
    )
    {
        $this->middleware('auth')->only('create');
    }

    public function index()
    {
        $posts = $this->postsRepo->all();
        return view('blog::posts.index', compact('posts'));
    }

    public function create()
    {
        $posts = $this->postsRepo->all();
        $categories = $this->categoriesRepo->all();
        return view('blog::posts.create', compact('posts', 'categories'));
    }

    public function store(StorePostRequest $request)
    {
        $postCredentials = $request->validated();
        $uploadedFile = $this->fileUploaderBuilder
            ->setFile($request->file('image_url'))
            ->setDisk('public')
            ->setDirectory($request->has('image_directory') ? $request->input('image_directory') : '/blog/posts')
            ->setFileName($request->has('image_name') ? $request->input('image_name') : '')
            ->build()
            ->storeAs();
        $postCredentials['image_url'] = $uploadedFile;

        if ($request->has('video_url')) {
            $uploadedVideo = $this->fileUploaderBuilder
                ->setFile($request->file('video_url'))
                ->setDisk('public')
                ->setDirectory('/blog/videos')
                ->build()
                ->storeAs();

            $postCredentials['video_url'] = $uploadedVideo;
        }
        $postCredentials['time_to_read'] = $request->input('time_to_read');
        $postCredentials['user_id'] = auth()->user()->id;
        $postCredentials['published_at'] = !is_null($request->input('published_at')) ?
            TimestampConverterService::convert($request->input('published_at')) : null;

        $this->postsRepo->create($postCredentials);
        return redirect()->route('blog.posts.index')->with('success', 'پست با موفقیت ایجاد شد');
    }
}

