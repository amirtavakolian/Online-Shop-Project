<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
