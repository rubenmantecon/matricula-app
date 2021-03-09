<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Uf;
use App\Models\Enrolment;

class Enrolment_uf extends Model
{
    use HasFactory;

    public function enrolments(){
    	return $this->belongsTo(Enrolment::class);
    }
    public function ufs(){
    	return $this->belongsTo(Uf::class);
    }
}
