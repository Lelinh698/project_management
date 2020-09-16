<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


// class Teacher extends Model
// {
//     //
// }

class Teacher extends Authenticatable
{
 //    protected $table = 'teachers';
	public $timestamps = false;

	protected $fillable = [
        'username', 'password', 'name', 'email', 'phone', 'id_department', 'degree', 'birth', 'address'
    ];

    public function department() {
        return $this->belongsTo('App\Department', 'id_department');
    }
}