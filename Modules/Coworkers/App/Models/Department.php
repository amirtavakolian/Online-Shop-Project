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
        return $this->hasOne(Coworker::class);
    }

    public function getDepartmentBossAttribute()
    {
        return $this->boss_id && $this->boss_id == $this->boss->id ? $this->boss->fullname : 'تعیین نشده';
    }
}
