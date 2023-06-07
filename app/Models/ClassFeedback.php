<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassFeedback extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='class_feedbacks';

    public function zoom_class()
    {
        return $this->belongsTo('App\Models\ZoomMeeting','zoom_id');
    }

}
