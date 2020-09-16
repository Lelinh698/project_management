<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_criteria extends Model
{
    protected $table = 'teacher_criterias';
    public $timestamps = false;
    
    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }

    protected $fillable = [
        'name', 'weight', 'id_project', 'mark', 'type',
    ];
}
