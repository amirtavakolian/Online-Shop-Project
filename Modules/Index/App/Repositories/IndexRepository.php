<?php

namespace Modules\Index\App\Repositories;

use Modules\Index\App\Models\Banner;
use Modules\Index\App\Models\Product;
use Modules\Index\App\Repositories\Contract\IIndexRepository;

class IndexRepository implements IIndexRepository
{

    public function banners()
    {
        $banners = Banner::all();
        $slider = $banners->where('type', 'slider')->sortBy('priority');
        $indexTopBanners = $banners->where('type', 'index-top')->sortBy('priority');
        $indexBottomBanners = $banners->where('type', 'index-bottom')->sortBy('priority');
        return [$slider, $indexBottomBanners, $indexTopBanners];
    }

    public function products()
    {
        return Product::query()->where('status', 1)->get();
    }

}
