<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenentMembers extends Model
{
  /**
      * The attributes that are mass assignable.
      *
      * @var array
  */
	protected $table = 'tenent_members';

  public function family_details(){
    return $this->hasMany('App\Models\TenentFamily','tenent_member_id','id');
  }

}
