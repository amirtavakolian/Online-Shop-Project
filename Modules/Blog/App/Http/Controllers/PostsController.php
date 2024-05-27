<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Blog\App\Http\Requests\StorePostRequest;
use Modules\Blog\App\Http\Requests\UpdateBlogPostRequest;
use Modules\Blog\App\Models\Post;
use Modules\Blog\App\Repositories\iCategoriesRepo;
use Modules\Blog\App\Repositories\iPostsRepo;
use Modules\Blog\App\Repositories\iTagsRepo;
use Modules\Blog\App\Services\FileUploader\FileUploaderBuilder;
use Modules\Blog\App\Services\TimestampConverter\TimestampConverterService;

class PostsController extends Controller
{
    public function __construct(
        private iPostsRepo          $postsRepo,
        private iCategoriesRepo     $categoriesRepo,
        private iTagsRepo           $tagsRepo,
        private FileUploaderBuilder $fileUploaderBuilder
    )
    {
        $this->middleware('auth')->only('create');
    }

    public function index()
    {
        $posts = $this->postsRepo->all();
        return view('blog::panel.posts.index', compact('posts'));
    }

    public function create()
    {
        Gate::authorize('create');
        $posts = $this->postsRepo->all();
        $categories = $this->categoriesRepo->all();
        $tags = $this->tagsRepo->all();
        return view('blog::panel.posts.create', compact('posts', 'categories', 'tags'));
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
        $postCredentials['disable_comment'] = $request->has('disable_comment') ? 1 : 0;
        $postCredentials['published_at'] = !is_null($request->input('published_at')) ?
            TimestampConverterService::convert($request->input('published_at')) : null;

        $post = $this->postsRepo->create($postCredentials);
        $post->tags()->attach($request->tags_id);
        return redirect()->route('blog.posts.index')->with('success', 'پست با موفقیت ایجاد شد');
    }

    public function edit(Post $post)
    {
        Gate::authorize('edit', $post);
        $posts = $this->postsRepo->all();
        $categories = $this->categoriesRepo->all();
        $tags = $this->tagsRepo->all();
        return view('blog::panel.posts.edit', compact('post', 'categories', 'posts', 'tags'));
    }

    public function update(UpdateBlogPostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $postCredentials = $request->validated();
        if ($request->has('image_url')) {
            $uploadedFile = $this->fileUploaderBuilder
                ->setFile($request->file('image_url'))
                ->setDisk('public')
                ->setDirectory($request->has('image_directory') ? $request->input('image_directory') : '/blog/posts')
                ->setFileName($request->has('image_name') ? $request->input('image_name') : '')
                ->build()
                ->storeAs();
            $postCredentials['image_url'] = $uploadedFile;
        }
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
        $postCredentials['disable_comment'] = $request->has('disable_comment') ? 1 : 0;
        $postCredentials['published_at'] = !is_null($request->input('published_at')) ?
            TimestampConverterService::convert($request->input('published_at')) : null;
        $this->postsRepo->update($post, $postCredentials);
        $post->tags()->sync($request->tags_id);
        return redirect()->route('blog.posts.index')->with('success', 'پست با موفقیت آپدیت شد');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('destroy', $post);

        $this->postsRepo->destroy($post);
        return response()->json([
            'status' => 200,
            'message' => 'ok'
        ]);
    }
}

