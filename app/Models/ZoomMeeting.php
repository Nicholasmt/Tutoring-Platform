<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;
    protected $guarded=[];
    // protected $casts = [
    //   'date_time' => 'date',
    // ];
    
    public function booking()
    {
       return $this->belongsTo('App\Models\Booking','booking_id');
    } 
}
