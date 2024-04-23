<?php

namespace Modules\Auth\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicLogin extends Model
{
    use HasFactory;

    protected $table = 'magic_login';
    protected $fillable = ['email', 'token'];
}
