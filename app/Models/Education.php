<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='educations';
    
    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    }
}
