<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Req_enrol;

class Upload extends Model
{
    use HasFactory;
    public function req_enrols(){
    	return $this->belongsTo(Req_enrol::class);
    }
}
