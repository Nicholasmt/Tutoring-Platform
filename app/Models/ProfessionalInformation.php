<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalInformation extends Model
{
    protected $guarded=[];
    use HasFactory;
    protected $table='professional_informations';

    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    }
}
