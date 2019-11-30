<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $uploads ='/images/codehacking/admin/';


    protected $fillable = ['path'];











    public function getPathAttribute($photo){

    	return $this->uploads.$photo;
    }
}
