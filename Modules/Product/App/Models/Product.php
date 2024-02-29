<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(Attribute::class, 'attribute_variation_product');
    }
}








