<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = "post_tags";
    protected $fillable = ['name'];
}
