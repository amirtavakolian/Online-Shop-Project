<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'is_active', 'parent_id'];

    public function getCategoryStatusAttribute()
    {
        return $this->is_active ? ['text-success', 'فعال'] : ['text-danger', 'غیر فعال'];
    }

    public function isParentIdNull()
    {
        return $this->parent_id == null ? 'selected' : '';
    }

    public function isItemSelected($categoryId)
    {
        return $this->parent_id == $categoryId ? 'selected' : '';
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function isFilter($attribute)
    {
        return in_array($attribute->id, $this->attributes()->wherePivot('is_filter', 1)
            ->get()
            ->pluck('id')
            ->toArray());
    }

}
