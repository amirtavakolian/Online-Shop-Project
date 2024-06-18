<?php

namespace Modules\Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'boss_id'];

    public function boss()
    {
        return $this->belongsTo(Coworker::class);
    }

    public function getDepartmentBossAttribute()
    {
        return $this->boss_id ? [$this->boss->fullname, 'green'] : ['تعیین نشده', 'red'];
    }

    public function isBossSelected($coworker)
    {
        return $this->boss_id && $this->boss_id == $coworker->id;
    }
}
