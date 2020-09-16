<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_plan extends Model
{
    protected $table = 'teacher_plans';
    public $timestamps = false;
    
    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }

    protected $fillable = ['id_project', 'deadline', 'description'];
}
