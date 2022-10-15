<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocietyParking extends Model
{
    /**
      * The attributes that are mass assignable.
      *	
      * @var array
    */
	protected $table = 'society_parking';
  protected $fillable = ['society_id', 'owner_name', 'flat_no', 'vehicle_type', 'rc_number', 'is_insured', 'parking_no', 'created_by', 'created_at', 'updated_at' ];


}
