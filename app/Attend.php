<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    protected $table = 'attends';
    public $timestamps = false;
    public $incrementing = true;

    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function project() {
        return $this->belongsTo('App\Project');
    }

    protected $fillable = [
        'id_student', 'group_name', 'id_project'
    ];
}
