<?php

namespace Modules\Product\App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
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

    public function update(Product $product, $data)
    {
        $product->update([
            "name" => $data['name'],
            "brand_id" => $data['brand_id'],
            "is_active" => $data['is_active'],
            "description" => $data["description"],
            "delivery_amount_per_product" => $data["delivery_amount_per_product"],
            "delivery_amount" => $data["delivery_amount"],
        ]);
        $product->tags()->sync($data['tag_ids']);
        $product->attributes()->sync($data['attribute_values']);
        foreach ($data['variation_values'] as $attribute) {
            $product->variationAttribute()->sync([$data["attirbute_id"] => $attribute]);
        }
    }

    public function updateProductCategory()
    {

    }
}
