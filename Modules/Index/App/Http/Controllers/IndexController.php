<?php

namespace Modules\Index\App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $categories = $this->indexRepository->categories();
        return view('index::index', compact('sliders', 'indexBottomBanners', 'indexTopBanners', 'products', 'categories'));
    }
}
