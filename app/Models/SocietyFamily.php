<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocietyFamily extends Model
{
    /**
      * The attributes that are mass assignable.
      *	
      * @var array
    */
	protected $table = 'society_family_members';

  protected $fillable = ['society_id', 'society_member_id', 'family_name', 'family_father_name', 'family_mother_name', 'family_gender', 'family_contact_no', 'family_dob', 'family_marriage', 'family_occupation', 'created_at', 'updated_at'];


}
