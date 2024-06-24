<?php

namespace Modules\Index\App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Product extends Model
{
    use HasFactory;

    public function variationAttribute()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_variation_product')
            ->withPivot(Schema::getColumnListing('attribute_variation_product'));
    }

    public function isInSaleDateRange()
    {
        foreach ($this->variationAttribute as $attribute) {
            if ($attribute->pivot->date_on_sale_from != null && $attribute->pivot->date_on_sale_to != null) {
                if (Carbon::parse($attribute->pivot->date_on_sale_from)->lte(Carbon::now()) &&
                    Carbon::now()->lte($attribute->pivot->date_on_sale_to)) {
                    return true;
                }
            }
        }
    }

    public function salePrice()
    {
        return $this->variationAttribute->first()->pivot->sale_price;
    }

    public function price()
    {
        return $this->variationAttribute->first()->pivot->price;
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)
            ->withPivot(Schema::getColumnListing('attribute_product'));
    }
}
