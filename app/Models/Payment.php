<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
      'billing_date' => 'date',
    ];

    public function teachers()
    {
       return $this->belongsTo('App\Models\Users','teacher');
    } 

    public function students()
    {
       return $this->belongsTo('App\Models\Users','student');
    } 

}
