<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function productss()
    {
        return $this->belongsToMany(Product::class, 'attribute_variation_product');
    }
}
