<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assess extends Model
{
    protected $table = 'assesses';
    public $timestamps = false;
    
    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }
}
