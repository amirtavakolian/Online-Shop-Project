<?php

namespace Modules\Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoworkerRefer extends Model
{

    use HasFactory;

    protected $table = 'ticket_coworker_refer';

    protected $fillable = ["from_coworker_id", "department_id", "ticket_id", "to_coworker_id"];
}


