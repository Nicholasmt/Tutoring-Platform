<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function user()
    { 
        return $this->belongsTo('App\Models\Users','user_id');
    }

    public function category()
    { 
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
