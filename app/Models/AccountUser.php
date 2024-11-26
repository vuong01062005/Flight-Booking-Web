<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AccountUser extends Model
{
    use Notifiable;

    protected $table = 'account_user';

    protected $fillable = [
        'userName',
        'firstName',
        'lastName',
        'Email',
        'BirthDay',
        'Phone',
        'Avatar',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
