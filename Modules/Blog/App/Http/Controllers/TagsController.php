<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\App\Http\Requests\UpdateBlogTagRequest;
use Modules\Blog\App\Models\Tag;
use Modules\Blog\App\Repositories\iTagsRepo;
use Modules\Tags\App\Http\Requests\StoreTagRequest;

class TagsController extends Controller
{

    public function __construct(private iTagsRepo $tagsRepo)
    {
    }

    public function index()
    {
        $tags = $this->tagsRepo->all();
        return view('blog::tag.index', compact('tags'));
    }

    public function store(StoreTagRequest $request)
    {
        $this->tagsRepo->store($request->validated());
        return redirect()->back()->with('success', 'تگ با موفقیت ایجاد شد');
    }

    public function edit(Tag $tag)
    {
        return view('blog::tag.edit', compact('tag'));
    }

    public function update(Tag $tag, UpdateBlogTagRequest $request)
    {
        $this->tagsRepo->update($request->validated(), $tag);
        return redirect()->route('blog.tags.index')->with('success', 'تگ با موفقیت آپدیت شد');
    }

}
