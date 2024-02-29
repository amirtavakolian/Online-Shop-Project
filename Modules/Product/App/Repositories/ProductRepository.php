<?php

namespace Modules\Product\App\Repositories;

use Modules\Product\App\Models\Product;
use Modules\Product\App\Repositories\Contract\IProductRepository;

class ProductRepository implements IProductRepository
{

    public function store(array $productData)
    {
        return Product::query()->create($productData);
    }

    public function storeImages(Product $product, array $images)
    {
        $imageData = array_map(function ($image) {
            return ['image' => $image];
        }, $images);
        $product->images()->createMany($imageData);
    }

    public function storeAttributes(Product $product, $attributes)
    {
        $data = array_map(function ($value, $attribute) {
            return [
                "attribute_id" => $attribute,
                "value" => $value
            ];
        }, $attributes, array_keys($attributes));
        $product->attributes()->sync($data);
    }

    public function storeVariationAttributes(Product $product, $attributes)
    {
        $refactorAttributes = [];
        foreach ($attributes as $key => $attribute) {
            foreach ($attribute as $k => $attributeValue) {
                $refactorAttributes[$k][$key] = $attributeValue;
            }
        }
        $refactorAttributes[0]['attribute_id'] = 1;
        $product->variationAttribute()->sync($refactorAttributes);
    }
}
