<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Panel\App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "content", "category_id", "stream_url",
        "related_post_id", "published_at", "time_to_read",
        "disable_comment", "image_url", "video_url", "user_id", "time_to_read"
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function relatedPost(): HasOne
    {
        return $this->hasOne(Post::class, 'related_post_id');
    }

    public function getImageNameAttribute()
    {
        preg_match("/[^\/]+$/", $this->image_url, $matches);
        return $matches[0];
    }

    public function getImageDirectoryAttribute()
    {
        preg_match('/^(.+\/)/', $this->image_url, $matches);
        return $matches[0];
    }
}
