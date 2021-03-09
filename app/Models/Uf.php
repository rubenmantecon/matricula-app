<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Mp;
use App\Models\Record;
use App\Models\Enrolment_uf;


class Uf extends Model
{
    use HasFactory;

    public function mps(){
    	return $this->belongsTo(Mp::class);
    }
    public function records(){
    	return $this->hasMany(Record::class);
    }
    public function enrolments_ufs(){
    	return $this->hasMany(Enrolment_uf::class);
    }
}
