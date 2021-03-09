<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Upload;
use App\Models\Enrolment;


class Req_enrol extends Model
{
    use HasFactory;
    public function uploads(){
    	return $this->hasMany(Upload::class);
    }
    public function enrolements(){
    	return $this->belongsTo(Enrolment::class);
    }
}
