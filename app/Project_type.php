<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_type extends Model
{
    protected $table = 'project_types';
    public $timestamps = false;
    
    public function project() {
        return $this->hasMany('App\Project', 'id_project_type');
    }
}
