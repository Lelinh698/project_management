<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_criteria extends Model
{
    protected $table = 'department_criterias';
    public $timestamps = false;
    
    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }

    protected $fillable = [
        'name', 'weight', 'id_project', 'mark',
    ];
}
