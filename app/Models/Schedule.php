<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table='schedules';
    protected $guarded=[];

    public function user()
    { 
        return $this->belongsTo('App\Models\Users','user_id');
    }
}
