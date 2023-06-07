<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $guarded=[];
    protected $table='personal_informations';
    use HasFactory;
   
    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    }
}
