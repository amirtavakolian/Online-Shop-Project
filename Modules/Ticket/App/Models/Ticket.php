<?php

namespace Modules\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ["title", "priority", "department_id", "content", "user_id"];

    public function attachments()
    {
        return $this->morphMany(TicketAttachment::class, 'attachmentable');
    }

    public static function hasOpenTicketForDepartment($userId, $departmentId)
    {
        return self::query()->where('user_id', $userId)->where('department_id', $departmentId)->first();
    }

}
