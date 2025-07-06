<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User2 extends Model
{
    protected $table = 'users2';

    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'role',
        'last_login',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}
