<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    public $timestamps = false;

    protected $fillable = [
        'id_teacher',
        'id_department',
        'id_project_type',
        'name'
    ];
    
    public function teacher() {
        return $this->belongsTo('App\Teacher');
    }

    public function department() {
        return $this->belongsTo('App\Department');
    }

    public function student() {
        return $this->belongsToMany('App\Student')->using('App\Attend')->withPivot('group_name');
    }

    public function project_type() {
        return $this->belongsTo('App\Project_type', 'id_project_type');
    }

    public function department_plan() {
        return $this->hasMany('App\Department_plan');
    }

    public function teacher_plan() {
        return $this->hasMany('App\Teacher_plan', 'id_project');
    }

    public function department_criteria() {
        return $this->hasMany('App\Department_criteria', 'id_project');
    }

    public function teacher_criteria() {
        return $this->hasMany('App\Teacher_criteria', 'id_project');
    }

    public function document() {
        return $this->hasMany('App\Document', 'id_project');
    }

    public function report() {
        return $this->hasMany('App\Report', 'id_project');
    }

    public function progress_result() {
        return $this->hasMany('App\Progress_result', 'id_project');
    }

    public function assess() {
        return $this->hasOne('App\Assess', 'id_project');
    }
}
