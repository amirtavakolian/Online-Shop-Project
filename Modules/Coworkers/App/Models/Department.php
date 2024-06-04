<?php

namespace Modules\Coworkers\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function boss()
    {
        return $this->hasOne(Coworker::class);
    }

    public function getDepartmentBossAttribute()
    {
        return $this->boss->name != null ? $this->boss->name : 'تعیین نشده';
    }
}
