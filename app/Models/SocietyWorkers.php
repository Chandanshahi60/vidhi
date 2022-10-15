<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocietyWorkers extends Model
{
    /**
      * The attributes that are mass assignable.
      *	
      * @var array
    */
	protected $table = 'society_workers';
  protected $fillable = ['society_id','name','f_name','aadhar_card','address','permanent_address','flat_no','created_by','created_at','updated_at'];


}
