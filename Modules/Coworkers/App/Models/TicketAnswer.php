<?php

namespace Modules\Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAnswer extends Model
{

    use HasFactory;

    protected $table = "ticket_answers";
    protected $fillable = ["ticket_id", "content", "coworker_id"];
    protected $with = ['coworker'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function coworker()
    {
        return $this->belongsTo(Coworker::class);
    }

}

