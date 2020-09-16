<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    public $timestamps = false;
    
    public function project() {
        return $this->hasMany('App\Project');
    }

    public function teacher() {
        return $this->hasMany('App\Teacher', 'id_department');
    }
}
