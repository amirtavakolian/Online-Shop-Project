<?php

namespace Modules\Index\App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function categories(Category $category)
    {
        $categoryAttributes = [];
        foreach ($category->products as $product) {
            foreach ($product->attributes as $attribute) {
                $categoryAttributes[$attribute->name][] = $attribute->pivot->value;
            }
            foreach ($product->variationAttribute as $variationAttribute) {
                $categoryAttributes[$variationAttribute->name][] = $variationAttribute->pivot->value;
            }
        }
        $attributes = array_map(function ($a) {
            return array_unique($a);
        }, $categoryAttributes);

        return view('index::category', compact('category', 'attributes'));
    }
}
