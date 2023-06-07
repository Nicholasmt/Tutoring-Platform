<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
      'date' => 'date',
    ];


    public function teacher()
    {
       return $this->belongsTo('App\Models\Users','teacher_booked');
    } 

    public function who_booked()
    {
       return $this->belongsTo('App\Models\Users','booked_by');
    } 

    public function category()
    {
       return $this->belongsTo('App\Models\Category','category_id');
    } 
}
