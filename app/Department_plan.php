<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_plan extends Model
{
    protected $table = 'department_plans';
    public $timestamps = false;
    
    public function project() {
        return $this->belongsTo('App\Project');
    }

    protected $fillable = [
        'name', 'description', 'request', 'deadline'
    ];
}
