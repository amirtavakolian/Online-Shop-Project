<?php

namespace Modules\Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coworker extends Model
{
    use HasFactory;

    protected $fillable = ["firstname", "lastname", "username", "password", "department_id"];

    public function department()
    {
        return $this->belongsTo(Department::class, 'boss_id');
    }

    public function getFullnameAttribute()
    {
        return $this->firstname . " " . $this->lastname;
    }
}
