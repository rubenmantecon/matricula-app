<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Uf;

class Record extends Model
{
    use HasFactory;
    public function users(){
    	return $this->belongsTo(User::class);
    }
    public function ufs(){
    	return $this->belongsTo(Uf::class);
    }
    
}
