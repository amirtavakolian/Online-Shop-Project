<?php

namespace Modules\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\App\Models\User;
use Modules\Coworkers\App\Models\Department;
use Modules\Ticket\App\Enum\TicketStatus;

class Ticket extends Model
{

    use HasFactory;

    protected $appends = ['ticket_status'];
    protected $fillable = ["title", "priority", "department_id", "content", "user_id"];

    public function attachments()
    {
        return $this->morphMany(TicketAttachment::class, 'attachmentable');
    }

    public static function hasOpenTicketForDepartment($userId, $departmentId)
    {
        return self::query()->where('user_id', $userId)->where('department_id', $departmentId)->first();
    }

    public function getTicketStatusAttribute(): array
    {
        return TicketStatus::getValue(strtoupper($this->status));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketAnswer()
    {
        return $this->hasMany(TicketAnswer::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function updateTicketStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function isClosed()
    {
        return $this->status == strtolower(TicketStatus::CLOSED->name);
    }
}
