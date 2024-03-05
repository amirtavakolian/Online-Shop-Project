<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function isSelected($productBrandId)
    {
        return $this->id == $productBrandId ? "selected" : "";
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
