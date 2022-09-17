<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSmsCode extends Model
{
    use HasFactory;

    protected $table = 'users_sms_code';

    protected $fillable = [
        'user_id',
        'code',
        'status',
    ];

    const STATUS_NEW = 'new';
    const STATUS_USED = 'used';
}
