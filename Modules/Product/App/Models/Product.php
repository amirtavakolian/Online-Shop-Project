<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "slug", "brand_id", "description",
        "category_id", "primary_image", "delivery_amount",
        "delivery_amount_per_product", "is_active"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function variationAttribute()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_variation_product')
            ->withPivot(Schema::getColumnListing('attribute_variation_product'));
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function isProductActive()
    {
        return $this->is_active == 0 ? "selected" : ($this->is_active != 1 ? "selected" : "");
    }

    public function isTagSelected($tagId)
    {
        return in_array($tagId, $this->tags()->withPivot('tag_id')
            ->pluck('tag_id')
            ->toArray()) ? "selected" : "";
    }

    public function getProductActiveStatusAttribute()
    {
        return $this->is_active ? "فعال" : "غیر فعال";
    }
}








