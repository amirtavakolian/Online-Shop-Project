<?php

namespace Modules\Index\App\Actions;

use Modules\Index\App\Models\Category;

class CategoryAttributeProcessor
{
    public function handle(Category $category): array
    {
        // Collect attributes through products within the category
        foreach ($category->productAttributes as $productAttribute) {
            $categoryAttributes[$productAttribute->attribute->name][] = $productAttribute->value;
        }

        // Collect variation attributes through products within the category
        foreach ($category->productVariations as $productVariation) {
            $categoryAttributes[$productVariation->attribute->name][] = $productVariation->value;
        }

        // Remove duplicate values for each attribute
        return array_map(function ($attributeValues) {
            return array_unique($attributeValues);
        }, $categoryAttributes);
    }
}
