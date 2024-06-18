<?php

namespace Modules\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $fillable = ["file_path"];

    protected $table = "ticket_attachments";

    public function attachmentable(): MorphTo
    {
        return $this->morphTo();
    }
}
