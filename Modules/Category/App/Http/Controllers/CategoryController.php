<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Category\App\Http\Requests\StoreCategoryRequest;
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

}
