<?php

namespace Modules\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Coworkers\App\Models\Coworker;

class TicketAnswer extends Model
{
    use HasFactory;

    protected $table = "ticket_answers";
    protected $fillable = ["ticket_id", "content", "coworker_id"];

    public function coworker()
    {
        return $this->belongsTo(Coworker::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

