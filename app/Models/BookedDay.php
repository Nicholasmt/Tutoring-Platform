<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedDay extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
      'date' => 'date',
      ];

    public function teacher()
    {
       return $this->belongsTo('App\Models\Users','teacher_id');
    }

}
