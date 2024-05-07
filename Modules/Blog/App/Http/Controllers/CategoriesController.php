<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\App\Http\Requests\StoreCategoryRequest;
use Modules\Blog\App\Http\Requests\UpdateCategoryRequest;
use Modules\Blog\App\Models\Category;
use Modules\Blog\App\Repositories\iCategoriesRepo;

class CategoriesController extends Controller
{

    public function __construct(private iCategoriesRepo $categoriesRepo)
    {
    }

    public function index()
    {
        $categories = $this->categoriesRepo->all();
        return view('blog::categories.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoriesRepo->store($request->validated());
        return redirect()->route('blog.categories.index')->with('success', 'دسته بندی با موفقیت ایجاد شد');
    }

    public function edit(Category $category)
    {
        return view('blog::categories.edit', compact('category'));
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->categoriesRepo->update($request->validated(), $category);
        return redirect()->route('blog.categories.index')->with('success', 'دسته بندی با موفقیت آپدیت شد');
    }

    public function destroy(Category $category)
    {
        $this->categoriesRepo->delete($category);
        return [
            'status' => 200,
            'message' => 'دسته بندی با موفقیت حذف شد'
        ];
    }
}
