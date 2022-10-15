<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocietyMembers extends Model
{
  /**
      * The attributes that are mass assignable.
      *
      * @var array
  */
	protected $table = 'society_members';
  protected $fillable = ['society_id', 'full_name', 'flat_no', 'contact_no', 'property_type', 'property_owned', 'property_owner_name', 'owner_contact_no', 'owner_address', 'address', 'updated_by', 'created_at', 'updated_at'];

  public function family_details(){
    return $this->hasMany('App\Models\SocietyFamily','society_member_id','id');
  }

  public function nominee_detail(){
    return $this->hasMany('App\Models\Nomination_detail','owner_id','id');
  }

}
