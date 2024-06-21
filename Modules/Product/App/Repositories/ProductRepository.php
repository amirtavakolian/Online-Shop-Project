<?php

namespace Modules\Product\App\Repositories;

use Modules\Product\App\Models\Product;
use Modules\Product\App\Repositories\Contract\IProductRepository;

class ProductRepository implements IProductRepository
{

    public function store(array $productData)
    {
        return Product::query()->create([
            "name" => $productData["name"],
            "slug" => $productData["slug"],
            "brand_id" => $productData["brand_id"],
            "category_id" => $productData["category_id"],
            "description" => $productData["description"],
            "primary_image" => $productData["primary_image"],
            "delivery_amount" => $productData["delivery_amount"],
            "delivery_amount_per_product" => $productData["delivery_amount_per_product"],
        ]);
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
        $product->attributes()->sync($attributes);
    }

    public function storeVariationAttributes(Product $product, $attributes)
    {
        $product->variationAttribute()->sync($attributes);
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
