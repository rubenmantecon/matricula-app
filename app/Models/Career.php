<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\Term;
use App\Models\Enrolment;
use App\Models\Mp;

class Career extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['term_id', 'name' , 'code' , 'description'];
    protected $dates = ['deleted_at'];

    public function terms(){
    	return $this->belongsTo(Term::class);
    }
    public function enrolments(){
    	return $this->hasMany(Enrolment::class);
    }
    public function mps(){
    	return $this->hasMany(Mp::class);
    }

}

?>