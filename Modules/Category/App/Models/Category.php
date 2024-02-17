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
}
