<?php

namespace Modules\Index\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Index\App\Models\Attribute;
use Modules\Index\App\Models\Product;

class Category extends Model
{
    use HasFactory;

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
}
