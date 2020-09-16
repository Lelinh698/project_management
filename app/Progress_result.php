<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress_result extends Model
{
    protected $table = 'progress_results';
    public $timestamps = false;
    
    public function project() {
        return $this->belongsTo('App\Project', 'id_project');
    }

    protected $fillable = [
        'diary_work', 'done_work', 'remain_work', 'id_project'
    ];
}
