<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\Career;
use App\Models\Enrolment;

class Term extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $fillable = ['start', 'end' , 'name' , 'description'];
  protected $dates = ['deleted_at'];

  public $timestamps = false; //[DIRTY PATCH] This helps avoid errors when running a factory, but it's a bug that needs fixing

  public function careers(){
    return $this->hasMany(Career::class);
  }
  public function enrolments(){
    return $this->hasMany(Enrolment::class);
  }
}
