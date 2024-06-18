<?php

namespace Modules\Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Ticket\App\Models\Ticket;

class Coworker extends Authenticatable
{

    use HasFactory;

    protected $fillable = ["firstname", "lastname", "username", "password", "department_id"];

    public function department()
    {
        return $this->hasOne(Department::class, 'boss_id');
    }

    public function getFullnameAttribute()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function departmentt()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'coworker_id');
    }

    public function openedTicketsBy()
    {
        return $this->tickets()
            ->where('is_opened', 1)
            ->where('status', '!=', 'closed')
            ->count();
    }



}
