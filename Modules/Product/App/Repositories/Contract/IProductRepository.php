<?php

namespace Modules\Product\App\Repositories\Contract;

use Modules\Product\App\Models\Product;

interface IProductRepository
{
    public function store(array $productData);

    public function storeImages(Product $product, array $images);

    public function storeAttributes(Product $product, $attributes);

    public function storeVariationAttributes(Product $product, $attributes);
}
