<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocietyCommitte extends Model
{
    /**
      * The attributes that are mass assignable.
      *	
      * @var array
    */
	protected $table = 'society_committee';
  protected $fillable = ['society_id', 'name', 'designation', 'contact_no', 'from_date', 'till_date', 'address', 'created_at','updated_by','updated_at'];
}
