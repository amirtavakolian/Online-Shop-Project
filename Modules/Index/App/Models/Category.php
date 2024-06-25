<?php

namespace Modules\Index\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Category extends Model
{
    use HasFactory;

    protected $with = ['children'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot(['is_filter', 'is_variation']);
    }

    public function withFilterAttribute()
    {
        return [
            "variation" => $this->attributes()->wherePivot('is_variation', 1)->get(),
            "attributes" => $this->attributes()->wherePivot('is_filter', 1)->get(),
        ];
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function productAttributes()
    {
        return $this->hasManyThrough(ProductAttribute::class, Product::class);
    }

    public function productVariations()
    {
        return $this->hasManyThrough(ProductVariations::class, Product::class);
    }

    public function categoryProductsAttributes()
    {
        foreach ($this->productAttributes as $productAttribute) {
            $categoryAttributes[$productAttribute->attribute->name][] = $productAttribute->value;
        }
        return $categoryAttributes;
    }

    public function categoryProductsVariations()
    {
        foreach ($this->productVariations as $productVariation) {
            $categoryVariationAttributes[$productVariation->attribute->name][] = $productVariation->value;
        }
        return $categoryVariationAttributes;
    }
}
