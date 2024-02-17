<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Category\App\Http\Requests\StoreCategoryRequest;
use Modules\Category\App\Models\Category;
use Modules\Category\App\Repositories\Contract\iCategoryRepo;

class CategoryController extends Controller
{

    public function __construct(private iCategoryRepo $categoryRepo)
    {
    }

    public function index()
    {
        $categoriesCount = $this->categoryRepo->count();
        $categories = $this->categoryRepo->all();
        return view('category::index', compact('categoriesCount', 'categories'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->all();
        return view('category::create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $this->categoryRepo->store($request->validated());
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('failed', 'مشکلی پیش آمده', 500);
        }
        return redirect()->route('category.index')->with('success', 'دسته بندی با موفقیت ساخته شد');
    }

    public function edit(Category $category)
    {
        $categories = $this->categoryRepo->parents();
        return view('category::edit', compact('categories', 'category'));
    }

    public function update(UpdatePostRequest $request, Category $category)
    {
        try {
            $this->categoryRepo->update($category, $request->validated());
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('failed', 'مشکلی در آپدیت پیش آمده', 500);
        }
        return redirect()->route('category.index')->with('success', 'دسته بندی با موفقیت بروز رسانی شد');
    }

    public function destroy(Category $category)
    {
        $this->categoryRepo->destroy($category);
    }

}
