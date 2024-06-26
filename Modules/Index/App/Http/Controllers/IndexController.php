<?php

namespace Modules\Index\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Index\App\Actions\CategoryAttributeProcessor;
use Modules\Index\App\Actions\ProductsBuilder;
use Modules\Index\App\Models\Category;
use Modules\Index\App\Repositories\Contract\IIndexRepository;

class IndexController extends Controller
{

    public function __construct(private IIndexRepository $indexRepository)
    {
    }

    public function index()
    {
        list($sliders, $indexBottomBanners, $indexTopBanners) = $this->indexRepository->banners();
        $products = $this->indexRepository->products();
        return view('index::index', compact('sliders', 'indexBottomBanners', 'indexTopBanners', 'products'));
    }

    public function categories(Request $request, Category $category, CategoryAttributeProcessor $categoryAttributeProcessor)
    {
        $attributes = $categoryAttributeProcessor->handle($category);
        return view('index::category', compact('category', 'attributes'));
    }
}
