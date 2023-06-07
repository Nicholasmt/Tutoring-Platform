<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cerification extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='certifications';

    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    }
}
