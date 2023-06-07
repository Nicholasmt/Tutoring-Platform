<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function meeting()
    {
       return $this->belongsTo('App\Models\ZoomMeeting','meeting_id');
    }
}
