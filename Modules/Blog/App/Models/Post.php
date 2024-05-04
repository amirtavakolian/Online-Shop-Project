<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "content", "category_id", "stream_url",
        "related_post_id", "published_at", "time_to_read",
        "disable_comment", "image_url", "video_url", "user_id", "time_to_read"
    ];
}
