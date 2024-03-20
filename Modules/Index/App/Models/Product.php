<?php

namespace Modules\Index\App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Modules\Index\App\Models\ProductImage;

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
        $productVariation = $this->variationAttribute->first()->pivot;
        if ($productVariation->date_on_sale_from != null) {
            $now = Carbon::parse(Carbon::now());
            $salesStartDate = Carbon::parse($productVariation->date_on_sale_from);
            $salesEndDate = Carbon::parse($productVariation->date_on_sale_to);

            if ($now->startOfDay()->gte($salesStartDate->startOfDay())
                &&
                $now->startOfDay()->lte($salesEndDate->startOfDay())
            ) {
                return true;
            }
        }
        return false;
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
