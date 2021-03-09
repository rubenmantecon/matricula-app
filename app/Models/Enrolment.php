<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Term;
use App\Models\Career;
use App\Models\User;
use App\Models\Enrolment_uf;
use App\Models\Req_enrol;

class Enrolment extends Model
{
    use HasFactory;

    public function terms(){
    	return $this->belongsTo(Term::class);
    }
    public function careers(){
    	return $this->belongsTo(Career::class);
    }
    public function users(){
    	return $this->belongsTo(User::class);
    }
    public function enrolment_ufs(){
    	return $this->hasMany(Enrolment_uf::class);
    }
    public function req_enrols(){
    	return $this->belongsTo(Req_enrol::class);
    }

}
