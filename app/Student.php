<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    // protected $table = 'students';
    public $timestamps = false;

	protected $fillable = [
        'name', 'mssv', 'email', 'phone', 'class', 'year', 'birth', 'address', 'username', 'password'
    ];
}
