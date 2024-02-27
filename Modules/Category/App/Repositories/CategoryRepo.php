<?php

namespace Modules\Category\App\Repositories;

use Modules\Category\App\Models\Category;
use Modules\Category\App\Repositories\Contract\iCategoryRepo;

class CategoryRepo implements iCategoryRepo
{

    public function all()
    {
        return Category::all();
    }

    public function store(array $data)
    {
        $category = Category::query()->create([
            "name" => $data["name"],
            "slug" => $data["slug"],
            "parent_id" => $data["parent_id"],
            "is_active" => $data["is_active"],
            "description" => $data["description"]
        ]);
        if (array_key_exists('attribute_ids', $data)) {
            $category->attributes()->attach($data['attribute_is_filter_ids'], [
                'is_filter' => 1,
                'is_variation' => 0
            ]);
            $category->attributes()->attach($data['variation_id'], [
                'is_filter' => 0,
                'is_variation' => 1
            ]);
        }
    }

    public function count()
    {
        return $this->all()->count();
    }

    public function parents()
    {
        return Category::query()->where('parent_id', null)->get();
    }

    public function update(Category $category, $data)
    {
        $updatedCategory = $category->update($data);
        $category->attributes()->syncWithPivotValues($data['attribute_is_filter_ids'], [
            'is_filter' => 1,
            'is_variation' => 0
        ]);
        $category->attributes()->attach($data['variation_id'], [
            'is_filter' => 0,
            'is_variation' => 1
        ]);

    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
