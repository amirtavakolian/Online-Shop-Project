<?php

namespace Modules\Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\App\Models\User;
use Modules\Ticket\App\Enum\TicketStatus;
use Modules\Ticket\App\Models\TicketAttachment;

class Ticket extends Model
{

    use HasFactory;

    protected $appends = ['ticket_status'];
    protected $fillable = ["title", "priority", "department_id", "content", "user_id"];
    protected $with = ['ticketAnswer'];

    public function attachments()
    {
        return $this->morphMany(TicketAttachment::class, 'attachmentable');
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

    public function opened()
    {
        $this->is_opened = 1;
        $this->save();
    }

    public function openBy($coworkerId)
    {
        $this->coworker_id = $coworkerId;
        $this->save();
    }

    public function updateTicketStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function ticketAttachments()
    {
        return TicketAttachment::where('attachmentable_id', $this->id)->get();
    }

    public function updateTicketOpenedBy($coworker_id)
    {
        $this->coworker_id = $coworker_id;
        $this->save();
    }

}
