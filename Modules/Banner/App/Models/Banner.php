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

    public function IsStatusActive()
    {
        return $this->is_active != 1 ? 'selected' : '';
    }
}
