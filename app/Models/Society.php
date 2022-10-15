<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    /**
      * The attributes that are mass assignable.
      *
      * @var array
    */
	protected $table = 'society';
  protected $fillable = ['user_id', 'building_make_year','society_name', 'society_address', 'city', 'state', 'pincode', 'society_unique_id', 'total_flats', 'emergency_contact_no', 'email', 'rwa_registration', 'registration_date', 'last_election_held', 'election_due_date', 'last_audit', 'no_of_families', 'no_of_gates', 'created_by', 'security_guard_mobile', 'secrataty_mobile', 'builder_company_name', 'builder_company_phone', 'builder_company_address', 'building_rules', 'created_at', 'updated_at'];



  public function committe_details(){
    return $this->hasOne('App\Models\SocietyCommitte','society_id','id');
  }

  public function society_members_details(){
    return $this->hasOne('App\Models\SocietyMembers','society_id','id')->with('family_details','nominee_detail');
  }

  public function parking_details(){
    return $this->hasOne('App\Models\SocietyParking','society_id','id');
  }

  public function workers(){
    return $this->hasOne('App\Models\SocietyWorkers','society_id','id');
  }

  public function security(){
    return $this->hasOne('App\Models\SocietySecurity','society_id','id');
  }

}
