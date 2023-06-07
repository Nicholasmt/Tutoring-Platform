<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSchedule extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
      'day' => 'date',
      ];

    public function booking()
    {
       return $this->belongsTo('App\Models\Booking','booking_id');
    }

}
