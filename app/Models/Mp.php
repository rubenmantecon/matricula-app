<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Career;
use App\Models\Uf;

class Mp extends Model
{
    use HasFactory;

    public function careers(){
    	return $this->belongsTo(Career::class);
    }
    public function ufs(){
    	return $this->hasMany(Uf::class);
    }
}
