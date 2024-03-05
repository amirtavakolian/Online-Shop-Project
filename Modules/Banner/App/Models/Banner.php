<?php

namespace Modules\Banner\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "text", "priority",
        "is_active", "type", "button_text",
        "button_link", "image"
    ];
}
