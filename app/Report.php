<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    public $timestamps = false;
    
    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }

    protected $fillable = [
        'link', 'description', 'time', 'id_project'
    ];
}
