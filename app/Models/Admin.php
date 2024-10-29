<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Make sure you include this
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable // Change this line
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
