<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocietySecurity extends Model
{
    /**
      * The attributes that are mass assignable.
      *	
      * @var array
    */
	protected $table = 'society_security';
  protected $fillable = ['society_id', 'name', 'fathers_name', 'dob', 'education', 'address', 'permanent_address', 'aadhar_card', 'is_security_agency', 'agency_name', 'agency_address', 'agency_city', 'licence', 'created_at', 'updated_at'];


}
