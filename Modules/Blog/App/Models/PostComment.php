<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Panel\App\Models\User;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'content', 'parent_id', 'status', 'like', 'dislike'];

    protected $table = 'posts_comments';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(PostComment::class, 'parent_id')
            ->orderBy('created_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedComments()
    {
        return $this->status == 1;
    }

    public function getCommentStatusAttribute()
    {
        if ($this->status == 0) {
            return 'در انتظار تایید';
        }
        if ($this->status == 1) {
            return 'تایید شده';
        }
        if ($this->status == 2) {
            return 'رد شده';
        }
    }
}
