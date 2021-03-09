<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Profile_req;
use App\Models\Req_enrol;

class Requirement extends Model
{
    use HasFactory;
    public function profile_reqs(){
    	return $this->belongsTo(Profile_req::class);
    }
    public function req_enrols(){
    	return $this->hasMany(Req_enrol::class);
    }
    
}
